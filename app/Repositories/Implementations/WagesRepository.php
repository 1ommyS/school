<?php


namespace App\Repositories\Implementations;


use App\Enums\Wage;
use App\Models\Lesson;
use App\Repositories\Interfaces\IWagesRepository;


class WagesRepository implements IWagesRepository
{
    public function getWagesOnPeriod (string $start, string $end): float
    {
        $wages = Wage::PERCENT * Lesson::where([
                [
                    "date",
                    ">=",
                    $start . " 00:00:00"
                ],
                [
                    "date",
                    "<=",
                    $end . " 23:59:59"
                ]
            ])->sum("lesson_cost");
        return $wages;
    }
    public function getWagesOnPeriodInGroup ($group, string $start, string $end): float
    {
        return 0.4 * Lesson::where([
                [
                    "group_id",
                    $group->id
                ],
                [
                    "date",
                    ">=",
                    $start . " 00:00:00"
                ],
                [
                    "date",
                    "<=",
                    $end . " 23:59:59"
                ]
            ])->sum("lesson_cost");
    }

}