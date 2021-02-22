<?php

namespace App\Services\Implementations;

use App\utils\DateUtils;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RequestValidationService
{

    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function defineMethodAndYear (Request $request): array
    {
        $month = $request->month ?? date("m");
        $year = $request->year ?? date("Y");
        return [
            $month,
            $year
        ];
    }

    public function definePeriod ($start, $finish)
    {
        $days = [
            "понедельник" => 1,
            "вторник" => 2,
            "среда" => 3,
            "четверг" => 4,
            "пятница" => 5,
            "суббота" => 6,
            "воскресенье" => 7,
        ];

        $day_start = $start;
        $day_finish = $finish;


        if ( ($day = Carbon::parse($day_start)->getTranslatedDayName()) != "понедельник" ) {
            $day_start = Carbon::parse($day_start)->subDays($days[$day] - 1)->format("Y-m-d");
        }
        if ( ($day = Carbon::parse($day_finish)->getTranslatedDayName()) != "воскресенье" ) {
            $day_finish = Carbon::parse($day_finish)->addDays(7 - $days[$day])->format("Y-m-d");
        }
        $weeks = DateUtils::getWeeksByFirstAndLastDate($day_start, $day_finish);

        return [
            "weeks" => $weeks,
            "first" => $start,
            "last" => $finish
        ];
    }
}