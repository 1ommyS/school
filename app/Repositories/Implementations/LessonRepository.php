<?php

namespace App\Repositories\Implementations;

use App\Enums\Beneficiary;
use App\libs\VkBot;
use App\Models\Lesson;
use App\Models\Mark;
use App\Models\StudentGroups;
use App\Models\User;
use App\Repositories\Interfaces\ILessonRepository;
use Illuminate\Support\Facades\DB;


class LessonRepository implements ILessonRepository
{
    private MarkRepository $mark;

    public function __construct () { $this->mark = new MarkRepository(); }

    /**
     * @param $group_id
     * @return array
     */
    public function getLessonsDates ($group_id)
    {
        $lessons_duplicated_info = DB::table("student_lessons")
            ->select('date', 'lesson_number')
            ->where('group_id', $group_id)
            ->orderBy('date', 'desc')
            ->get();

        if ( empty($lessons_duplicated_info) ) return [];
        $dates = [];
        $lessons_numbers = [];
        $lessons_info = [];
        foreach ( $lessons_duplicated_info as $item ) {
            if ( !in_array($item->date, $dates) ) {
                $dates[] = $item->date;
                $lessons_numbers[] = $item->lesson_number;
            }
        }
        foreach ( $dates as $i => $v ) {
            $lessons_info[] = [
                'date' => $v,
                'lesson_number' => $lessons_numbers[$i]
            ];
        }
        return $lessons_info;
    }

    /**
     * @param $group_id
     * @param $date
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function getLessonInformation ($group_id, $date)
    {
        return DB::table("student_lessons")->select()->where([
            [
                'group_id',
                $group_id
            ],
            [
                'date',
                $date
            ]
        ])->first();
    }


    /**
     * @param int $student_id
     * @param string $attended_type
     * @param $request
     * @param $group_id
     * @param $lesson_number
     */
    public function addLesson (int $student_id, string $attended_type, $request, $group_id, $lesson_number)
    {
        $lesson_cost = [
            '1' => (int) $request->cost_home,
            '2' => (int) $request->cost_classic,
            '3' => (int) $request->cost_video,
        ];

        $student = StudentGroups::select()->where([
            [
                'student_id',
                $student_id
            ],
            [
                'group_id',
                $group_id
            ]
        ])->orderBy('id', 'desc')->first();

        $balance = $student->balance;
        if ( $student->balance < $lesson_cost[$attended_type] && $student->count_bonus_lessons != 0 ) {
            $student->count_bonus_lessons -= 1;
        } else {
            if ( $student->exempt )
                $student->balance = $student->balance - Beneficiary::Percent * $lesson_cost[$attended_type];
            else
                $student->balance = $student->balance - $lesson_cost[$attended_type];
        }
        $lesson_balance = $balance;
        $cost = $balance - $student->balance;
        if ( $cost == 0 ) {
            $cost = $lesson_cost[$attended_type];
        }
        $array_balance = [
            "old" => $balance,
            "new" => $student->balance
        ];

        $student->save();

        Lesson::insert([
            'group_id' => $group_id,
            "date" => $request->date,
            "homework" => $request->homework,
            'lesson_theme' => $request->lesson_theme,
            'balance_lesson' => $lesson_balance,
            'student_id' => $student_id,
            'payment_status' => $attended_type,
            "lesson_cost" => $cost,
            'cost_home' => $request->cost_home,
            'cost_classic' => $request->cost_classic,
            'cost_video' => $request->cost_video,
            'lesson_number' => $lesson_number
        ]);

        $mark_key = "{$student_id}mark";
        if ($request->$mark_key != -1) {
            $this->mark->saveStudentMark($student_id, $group_id, $request->$mark_key, $request->date);
        }
        $canUserGetMessageFromBot = (new UserRepository())->getUserById($student->student_id)->get_message;

    }

    /**
     * @param $group_id
     * @return int
     */
    public function getLessonNumber ($group_id): int
    {
        return DB::table('student_lessons')->select()->where('group_id', $group_id)->orderBy('lesson_number', 'desc')->first() !== null ? DB::table('student_lessons')->select()->where('group_id', $group_id)->orderBy('lesson_number', 'desc')->first()->lesson_number : 0;
    }

    /**
     * @param $information
     * @param $group_id
     * @param $date
     */
    public function editLesson ($information, $group_id, $date)
    {
        foreach ( $information as $key => $field ) {
            if ( is_numeric($key) ) {
                $prices = [
                    '1' => $this->getLessonRow($group_id, $key, $date)->cost_home,
                    '2' => $this->getLessonRow($group_id, $key, $date)->cost_classic,
                    '3' => $this->getLessonRow($group_id, $key, $date)->cost_video
                ];
                $new_prices = [
                    '1' => (int) $information['cost_home'],
                    '2' => (int) $information['cost_classic'],
                    '3' => (int) $information['cost_video']
                ];
                $new_mark = $information["mark_{$key}"];
                if ($new_mark != -1) {
                    Mark::where([["student_id", $key], ["group_id", $group_id], ["created_at", $date]])->update(["mark" => $new_mark]);
                }
                $old_payment_status = $this->getLessonRow($group_id, $key, $date)->payment_status;
                if ( $field !== $old_payment_status ) {
                    $difference = $new_prices[$field] - $prices[$old_payment_status];
                    $user = $this->getLessonRow($group_id, $key, $date);
                    $user->homework = $information["homework"];
                    $user->lesson_theme = $information["lesson_theme"];
                    $user->payment_status = $field;
                    $user->lesson_cost = $new_prices[$field];
                    $user->cost_home = $new_prices[1];
                    $user->cost_classic = $new_prices[2];
                    $user->cost_video = $new_prices[3];
                    $user->balance_lesson -= $difference;
                    $user->save();
                    $student_group = StudentGroups::where([
                        [
                            'student_id',
                            $key
                        ],
                        [
                            'group_id',
                            $group_id
                        ]
                    ])->first();
                    $student_group->balance -= $difference;
                    $student_group->save();
                }
            }
        }

    }

    /**
     * @param $group_id
     * @param int $key
     * @param $date
     * @return \App\Models\Lesson|\Illuminate\Database\Eloquent\Model|object|null
     */
    private function getLessonRow ($group_id, int $key, $date)
    {

        return Lesson::where([
            [
                'group_id',
                $group_id
            ],
            [
                'student_id',
                $key
            ],
            [
                'date',
                $date
            ]
        ])->first();
    }

    /**
     * @param $group_id
     * @param $date
     * @return array
     */
    public function getInformationAboutStudentsOnLesson ($group_id, $date)
    {
        $payments = DB::table("student_lessons")->select('student_id', 'payment_status')->where([
            [
                'group_id',
                $group_id
            ],
            [
                'date',
                $date
            ]
        ])->get();
        $students = [];
        foreach ( $payments as $item ) {
            $mark = Mark::where([
                    ["student_id", $item->student_id],
                    ["group_id",$group_id],
                    ["created_at",$date]
                ])
                ->first();
            $students[] = [
                'name' => User::find($item->student_id)->name,
                'payment_status' => $item->payment_status,
                'id' => $item->student_id,
                "mark" => $mark ? $mark->mark : null
            ];
        }
        return $students;

    }

    /**
     * @param $teacher_id
     * @param string $start
     * @param string $end
     * @param int $payment_status
     * @return int
     */
    public function getStudentAmountByPaymentStatusInTeacherGroups ($teacher_id, string $start, string $end, int $payment_status)
    {
        return count(DB::select("SELECT `id` FROM student_lessons WHERE payment_status = ? AND group_id IN (SELECT id FROM `groups` WHERE teacher_id = ?) AND date >= ? AND date <= ?", [
            $payment_status,
            $teacher_id,
            $start . " 00:00:00",
            $end . " 23:59:59"
        ]));
    }

    /**
     * @param $teacher_id
     * @return int
     */
    public function getStudentAmountInTeacherGroups ($teacher_id)
    {
        return count(DB::select("SELECT `id` FROM student_groups WHERE group_id IN (SELECT id FROM `groups` WHERE teacher_id = ?)", [
            $teacher_id,
        ]));
    }

    /**
     * @param $group
     * @param array $week
     * @param $payment_status
     * @return int
     */
    public function getStudentsByPaymentsStatusOnLesson ($group, array $week, $payment_status): int
    {
        return DB::table("student_lessons")->where([
            [
                "group_id",
                $group->id
            ],
            [
                "date",
                ">=",
                $week["start"] . " 00:00:00"
            ],
            [
                "date",
                "<=",
                $week["end"] . " 23:59:00"
            ],
            [
                "payment_status",
                $payment_status
            ]
        ])->count();
    }

    /**
     * @param $group
     * @param string $start
     * @param string $end
     * @return float
     */
}