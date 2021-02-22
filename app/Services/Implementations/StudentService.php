<?php

namespace App\Services\Implementations;


use App\Models\Group;
use App\Models\Kicked;
use App\Models\StudentGroups;
use App\Models\User;
use App\Repositories\Implementations\UserRepository;

class StudentService
{
    private UserRepository $repo;

    public function __construct ()
    {
        $this->repo = new UserRepository();
    }

    public function deleteStudent (int $id)
    {
        $this->repo->delete($id);
    }

    public function updateStudentInformationInGroup ($request, int $student_id, int $group_id)
    {
        switch ( $request->type ) {
            case "MONEY":
                $this->setNewStudentBalance($request->value, $student_id, $group_id);
                break;
            case "BONUSES":
                $this->setNewBonusesAmount($request->value, $student_id, $group_id);
                break;
            case "KICK":
                $this->kickFromGroup($student_id, $group_id);
                break;
            case "ADD":
                $this->addToGroup($request->value, $student_id);
                break;
        }
    }

    private function setNewStudentBalance ($value, int $student_id, int $group_id)
    {
        if ( !is_int($value) ) return;

        $this->repo->setBalance($value, $student_id, $group_id);
    }

    private function setNewBonusesAmount ($value, int $student_id, int $group_id)
    {
        if ( !is_int($value) || $value < 0 ) return;

        $this->repo->setBonuses($value, $student_id, $group_id);
    }

    private function kickFromGroup (int $student_id, int $group_id)
    {
        Kicked::create([
            'student_id' => $student_id,
            'group_name' => Group::where('id', $group_id)->first()->name_group,
        ]);

        $user = User::find($student_id);

        $user->finished = 1;

        $user->save();

        return StudentGroups::where([

            [
                'student_id',
                $student_id
            ],
            [
                "group_id",
                $group_id
            ]
        ])->first()->delete();
    }

    private function addToGroup ($value, int $student_id)
    {
        StudentGroups::create([
            "student_id" => $student_id,
            "group_id" => $value
        ]);
    }
}