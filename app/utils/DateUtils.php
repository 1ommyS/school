<?php


namespace App\utils;


use Carbon\Carbon;

class DateUtils
{

    public static function getWeeks (string $month, string $year): array
    {

        $days = [
            'Monday' => 1,
            'Tuesday' => 2,
            'Wednesday' => 3,
            "Thursday" => 4,
            "Friday" => 5,
            "Saturday" => 6,
            "Sunday" => 7,
        ];

        // порядковый номер дня недели первого дня месяца $monthNumber
        $day = self::getFirstMonday($month, $year, 1, 1);
        $firstMonthWeekDay = date("l", strtotime("01.{$month}.{$year}"));

        $amountDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $lastMonthWeekDay = date("l", strtotime(cal_days_in_month(CAL_GREGORIAN, $month, $year) . ".{$month}.{$year}"));

        $weekAmounts = ceil(($amountDays - $day) / 7);
        if ( $lastMonthWeekDay !== "Sunday" ) {
            $weekAmounts += 1;
        }
        $weeks = [];
        for ( $i = 0; $i < $weekAmounts; $i++ ) {
            $end = "$year-$month-";
            $end .= $day + 6;
            $start = "$day.$month.$year";
            if ( $day + 6 > $amountDays ) {
                $end = "$year-" . ($month + 1) . "-";
                $end .= 7 - $days[$lastMonthWeekDay];
            }

            $weeks[$i] = [
                "start" => "$year-$month-$day",
                "end" => "$end",
            ];
            $day += 7;
        }
        $week_parts = explode("-", $weeks[count($weeks) - 1]['end']);
        if ( $week_parts[1] > 12 ) {
            $week_parts[0] = (int) $week_parts[0] + 1;
            $week_parts[1] = 1;
        }
        $weeks[count($weeks) - 1]['end'] = implode("-", $week_parts);
        return $weeks;
    }

    public static function getFirstMonday ($monthNumber, string $year, $dayOfWeek, $weekNumber): int
    {

        $dayOfWeekFirstDayOfMonth = date('w', mktime(0, 0, 0, $monthNumber, 1, $year));


        // сколько дней осталось до дня недели $dayOfWeek относительно дня недели $dayOfWeekFirstDayOfMonth

        $diference = 0;


        // если нужный день недели $dayOfWeek только наступит относительно дня недели $dayOfWeekFirstDayOfMonth

        if ( $dayOfWeekFirstDayOfMonth <= $dayOfWeek ) {

            $diference = $dayOfWeek - $dayOfWeekFirstDayOfMonth;

        } // если нужный день недели $dayOfWeek уже прошёл относительно дня недели $dayOfWeekFirstDayOfMonth

        else {

            $diference = 7 - $dayOfWeekFirstDayOfMonth + $dayOfWeek;

        }

        return 1 + $diference + ($weekNumber - 1) * 7;

    }

    public static function getWeeksByFirstAndLastDate (string $day_start, string $day_finish)
    {
        $weeks = [];
        $index = 0;

        while ( strtotime($day_start) < strtotime($day_finish) ) {
            $weeks[$index] = [
                "start" => $day_start,
                "end" => Carbon::parse($day_start)->addDays(6)->format("Y-m-d")
            ];
            $index++;
            $day_start = Carbon::parse($day_start)->addDays(7)->format("Y-m-d");
        }
        return $weeks;
    }
}