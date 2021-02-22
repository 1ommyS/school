<?phpnamespace App\Repositories\Implementations;use App\Models\Group;use App\Models\Kicked;use App\Models\Lesson;use App\Models\StudentGroups;use App\Models\User;use App\Repositories\Interfaces\IGroupRepository;use Illuminate\Support\Facades\DB;class GroupRepository implements IGroupRepository{    /**     * @param string $id     * @return \App\Models\Group|mixed     */    public function findGroupById (string $id)    {        return Group::find($id);    }    /**     * @param string $id     * @return mixed     */    public function getGroupName (string $id)    {        return Group::select('name_group')            ->where('id', $id)            ->first()            ->name_group;    }    /**     * @param string $group_id     * @return \Illuminate\Support\Collection     */    public function getStudentsDataInGroup (string $group_id)    {        return StudentGroups::select('student_id', 'balance', 'count_bonus_lessons')            ->where('group_id', $group_id)            ->get();    }    /**     * @return array     */    public function getInfoAboutGroups (): array    {        $information = [];        $groups = Group::all();        $ages = [            1 => 'Школьники',            2 => 'Студенты',            3 => 'Взрослые',        ];        foreach ( $groups as $group ) {            $teacher_name = User::where('id', $group->teacher_id)->first()->name;            $information[] = [                'id' => $group->id,                'teacher_name' => $teacher_name,                'name_group' => $group->name_group,                'technology' => $group->technology,                'schedule' => $group->schedule,                'age' => $ages[$group->age],                'year' => $group->year,                'archive' => $group->archive,            ];        }        return $information;    }    /**     * @param $group_id     * @return array     */    public function getGroupMembersWithPayments ($group_id)    {        $members = DB::table('student_groups')->select('student_id')->where('group_id', $group_id)->get();        $student_payments = [];        foreach ( $members as $student ) {            $payments = $this->getInfoAboutStudentLesson($group_id, $student);            $student_name = User::find($student->student_id)->name;            $balance = $this->getInfoAboutStudentInGroup($student, $group_id);            $student_payments[] = [                'payments' => $payments,                'name' => $student_name,                'id' => $student->student_id,                'balance' => $balance->balance,                'bonuses' => $balance->count_bonus_lessons,                'color' => []            ];        }        foreach ( $student_payments as $i => $v ) {            foreach ( $v['payments'] as $k => $vv ) {                if ( $vv->balance_lesson > 1650 ) {                    $student_payments[$i]['color'][$k] = "#9CE1C6";                } elseif ( $vv->balance_lesson >= 550 && $vv->balance_lesson <= 1650 ) {                    $student_payments[$i]['color'][$k] = "#FFD37F";                } elseif ( $vv->balance_lesson <= 500 ) {                    $student_payments[$i]['color'][$k] = "#FF8F88";                }            }        }        return $student_payments;    }    /**     * @param $group_id     * @param mixed $student     * @return \Illuminate\Support\Collection     */    private function getInfoAboutStudentLesson ($group_id, $student): \Illuminate\Support\Collection    {        $payments = Lesson::select('payment_status', 'lesson_cost', 'balance_lesson')            ->where([                [                    'group_id',                    $group_id                ],                [                    'student_id',                    $student->student_id                ]            ])            ->orderBy('date', 'desc')            ->get();        return $payments;    }    /**     * @param $group_id     * @return \App\Models\StudentGroups|\Illuminate\Database\Eloquent\Model|object|null     */    private function getInfoAboutStudentInGroup ( $student, $group_id)    {        $balance = StudentGroups::select("balance", 'count_bonus_lessons')->where([            [                'student_id',                $student->student_id            ],            [                'group_id',                $group_id            ]        ])->first();        return $balance;    }    /**     * @param $group_id     * @param $student_id     * @return bool|null     * @throws \Exception     */    public function deleteStudent ($group_id, $student_id)    {        Kicked::create([            'student_id' => $student_id,            'group_name' => Group::where('id', $group_id)->first()->name_group,        ]);        $user = User::find($student_id);        $user->finished = 1;        $user->save();        return StudentGroups::where([['group_id', $group_id], ['student_id', $student_id]        ])->first()->delete();    }    /**     * @param $group_id     * @param $student_id     * @return bool     */    public function makeExempt ($group_id, $student_id)    {        return StudentGroups::where([            [                'group_id',                $group_id            ],            [                'student_id',                $student_id            ]        ])->update([            'exempt' => 1        ]);    }    /**     * @param $group_id     * @param $student_id     * @return bool     */    public function removeExempt ($group_id, $student_id)    {        return StudentGroups::where([            [                'group_id',                $group_id            ],            [                'student_id',                $student_id            ]        ])->update([            'exempt' => 0        ]);    }    /**     * @param $group_id     * @param $student_id     * @param $value     */    public function addBonus ($group_id, $student_id, $value)    {        $row = StudentGroups::where([            [                'group_id',                $group_id            ],            [                'student_id',                $student_id            ]        ])->first();        $row->count_bonus_lessons += $value;        $row->save();    }    /**     * @param $group_id     * @param $student_id     * @param $value     * @param $date     */    public function addPayment ($group_id, $student_id, $value, $date)    {        $row = StudentGroups::where([            [                'group_id',                $group_id            ],            [                'student_id',                $student_id            ]        ])->first();        $row->balance += $value;        $row->save();        $countBonusLessons = 0;        $countLessons = 0;        switch ( $value ) {            case 5000:                $countBonusLessons = 1;                $countLessons = 10;                break;            case 10000:                $countBonusLessons = 3;                $countLessons = 20;                break;            case 20000:                $countBonusLessons = 40;                $countLessons = 7;                break;            default:                $countLessons = (int) ($value / 500);        }        DB::table('transactions')->insert([            'student_id' => $student_id,            'date_transaction' => $date,            'sum_transaction' => $value,            'group_id' => $group_id,            'count_lessons' => $countLessons,            'count_bonus_lessons' => $countBonusLessons        ]);    }    /**     * @param $group_id     */    public function acrhiveGroup ($group_id)    {        Group::where('id', $group_id)->update(['archive' => 1]);    }}