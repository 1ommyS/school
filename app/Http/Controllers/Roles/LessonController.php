<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use App\libs\VkBot;
use App\Models\Group;
use App\Models\User;
use App\Repositories\Implementations\GroupRepository;
use App\Repositories\Implementations\LessonRepository;
use App\Repositories\Implementations\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class LessonController extends Controller
{

    private Group $model;
    private UserRepository $userRepository;
    private LessonRepository $lessonRepository;

    /**
     * LessonController constructor.
     * @param \App\Models\Group $model
     * @param \App\Repositories\Implementations\UserRepository $userRepository
     * @param \App\Repositories\Implementations\LessonRepository $lessonRepository
     */
    public function __construct (Group $model, UserRepository $userRepository, LessonRepository $lessonRepository)
    {
        $this->model = $model;
        $this->userRepository = $userRepository;
        $this->lessonRepository = $lessonRepository;
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @param $group_id
     * @param $date
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function lessonForm (Request $request, $group_id, $date)
    {
        $lesson_info = $this->lessonRepository->getLessonInformation($group_id, $date);
        $students = $this->lessonRepository->getInformationAboutStudentsOnLesson($group_id, $date);
        return view('pages.group.edit', compact('lesson_info', 'students', "group_id"));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param $group_id
     * @param $date
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editLesson (Request $request, $group_id, $date)
    {

        $this->lessonRepository->editLesson($request->all(), $group_id, $date);

        session()->flash("success", 'Урок отредактирован');

        return redirect()->back();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param $group_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function addlessonForm (Request $request, $group_id)
    {
        $student_ids = DB::table("student_groups")->select("student_id")->where('group_id', $group_id)->get();
        $students = [];
        foreach ( $student_ids as $studentId ) {
            $students[] = User::find($studentId->student_id);
        }
        $age = Group::find($group_id)->age;
        return view('pages.group.addlesson', compact('students', 'age', "group_id"));
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @param $group_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function addlesson (Request $request, $group_id)
    {
        $rules = [
            'date' => Rule::unique('student_lessons')->where(function ($query) use ($group_id) {
                return $query->where('group_id', $group_id);
            }),
        ];
        $messages = [
            'date.unique' => 'На эту дату занятие уже есть',
        ];
        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        $lesson_number = $this->lessonRepository->getLessonNumber($group_id) + 1;

        foreach ( $request->all() as $key => $item ) {
            if ( is_numeric($key) ) {
                $this->lessonRepository->addLesson($key, $request->$key, $request, $group_id, $lesson_number);
            }
        }
        session()->flash("success", 'Вы успешно добавили урок');


        return redirect("group/{$group_id}");

    }


}