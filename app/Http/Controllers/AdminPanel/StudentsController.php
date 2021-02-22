<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Kicked;
use App\Models\StudentGroups;
use App\Models\User;
use App\Services\Implementations\StudentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentsController extends Controller
{
    private StudentService $service;


    public function __construct (StudentService $service) { $this->service = $service; }

    public function updateStudentInformation (Request $request,  $student_id,  $group_id)
    {
        $decode_request = json_decode(file_get_contents("php://input"));
        $student_id = (int)($decode_request->student_id);
        $group_id =(int) ($decode_request->group_id);
        $this->service->updateStudentInformationInGroup($decode_request, $student_id, $group_id);
    }

    public function groups ()
    {
        return Group::select("id", "name_group")->get();
    }

    public function groupInformation (int $id, $student_id)
    {
        return StudentGroups::select("balance", "count_bonus_lessons")->where([["group_id", $id], ["student_id" , $student_id]])->first();
    }

    public function freeGroups (Request $request, int $id)
    {
        return Group::select("id", "name_group")->where("student_id", "!=", $id)->get();
    }

    public function studentGroups (int $id)
    {
        return DB::select("SELECT id, name_group FROM `groups` WHERE id in (SELECT group_id FROM student_groups WHERE student_id = ?)", [$id]);
    }

    public function students ()
    {
        return User::select(DB::raw("`id` as `key`, `login`, `name`, `link_vk`, `get_message`"))->where("role_id", 1)->get()->map(function ($el) {
            $el->group_amount = StudentGroups::where("id", $el->key)->count();
            $tags = [];
            if ( Kicked::where("student_id", $el->key)->first() != null )
                $tags [] = "выпустившийся";


            if ( StudentGroups::where([
                    [
                        "student_id",
                        $el->key
                    ],
                    [
                        "exempt",
                        1
                    ]
                ])->first() != null )
                $tags[] = "льготник";

            if ( empty($tags) ) $tags [] = "нет статусов";
            $el->tags = $tags;
            return $el;
        });
    }

    public function delete (Request $request, int $id)
    {
        $this->service->deleteStudent($id);

        return User::select(DB::raw("`id` as `key`, `login`, `name`, `link_vk`, `get_message`"))->where("role_id", 1)->get()->map(function ($el) {
            $el->group_amount = StudentGroups::where("id", $el->key)->count();
            return $el;
        });
    }

}
