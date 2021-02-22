<?php


namespace App\Services\Implementations;


use App\libs\VkBot;
use App\Models\Group;
use App\Models\StudentGroups;
use App\Models\User;
use App\Repositories\Implementations\GroupRepository;
use App\Repositories\Implementations\UserRepository;
use App\Services\Interfaces\IBalanceService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BalanceService implements IBalanceService
{

    public function updateBalance (int $payment_amount, string $id, $user_id): string
    {
        [
            $countBonusLessons,
            $countLessons,
        ] = $this->defineCountsLessons($payment_amount);

        $balances = [];

        $row = StudentGroups::select()
            ->where([
                [
                    'group_id',
                    $id,
                ],
                [
                    'student_id',
                    $user_id,
                ],
            ])
            ->first();

        $row->count_bonus_lessons += $countBonusLessons;
        $balances['old'] = $row->balance;
        $row->balance += (int) $payment_amount;
        $balances['new'] = $row->balance;
        $row->save();
        $groupInformation = Group::select('name_group', 'teacher_id')->where('id', $id)->first();
        $teacherName = User::select('name')->where('id', $groupInformation->teacher_id)->first()->name;
        $studentName = Auth::user()->name;
        $res = DB::table('transactions')->insert([
            [
                'student_id' => Auth::user()->id,
                'date_transaction' => date('Y-m-d H:i:s'),
                'sum_transaction' => (int) $payment_amount,
                'group_id' => $id,
                'count_lessons' => $countLessons,
                'count_bonus_lessons' => $countBonusLessons,
            ],
        ]);
        return $res ? "Баланс обновлен" : "Ошибка";
    }


    /**
     * @param int $balance
     * @return array|int[]
     */


    private function defineCountsLessons (int $balance): array
    {

        $countBonusLessons = 0;

        switch ( (int) $balance ) {

            case 5500:

                $countBonusLessons = 1;

                $countLessons = 10;

                return [
                    $countBonusLessons,
                    $countLessons,
                ];
            case 11000:
                $countBonusLessons = 3;
                $countLessons = 20;
                return [
                    $countBonusLessons,
                    $countLessons,

                ];

            case 22000:
                $countBonusLessons = 7;
                $countLessons = 40;
                return [
                    $countBonusLessons,
                    $countLessons,
                ];

            case 30250:
                $countBonusLessons = 9;
                $countLessons = 55;
                return [
                    $countBonusLessons,
                    $countLessons,
                ];
            default:
                $countLessons = (int) ($balance / 550);
        }
        return [
            $countBonusLessons,
            $countLessons,
        ];
    }
}