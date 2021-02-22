<?php

namespace App\Services\Implementations;


use App\Enums\PaymentStatuses;
use App\Enums\Roles;
use App\Models\Group;
use App\Models\StudentGroups;
use App\Models\User;
use App\Repositories\Implementations\LessonRepository;
use App\Repositories\Implementations\PremiumRepository;
use App\Repositories\Implementations\TransactionsRepository;
use App\Repositories\Implementations\UserRepository;
use App\Repositories\Implementations\WagesRepository;
use App\Services\Interfaces\IAnalyticService;
use App\utils\DateUtils;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AnalyticService implements IAnalyticService
{

    private PremiumRepository $premiumRepo;
    private LessonRepository $lessonRepo;
    private UserRepository $userRepo;
    private TransactionsRepository $transactionRepo;
    private WagesRepository $wagesRepo;

    /**
     * AnalyticService constructor.
     */
    public function __construct ()
    {
        $this->premiumRepo = new PremiumRepository();
        $this->lessonRepo = new LessonRepository();
        $this->userRepo = new UserRepository();
        $this->transactionRepo = new TransactionsRepository();
        $this->wagesRepo = new WagesRepository();
    }


    /**
     *  get all analytic for teacher in week
     * @param string|null $month
     * @param string|null $year
     * @return array
     */
    public function getTeacherAnalytic (string $month = null, string $year = null): array
    {
        $weeks = DateUtils::getWeeks($month, $year);
        $information = [];
        foreach ( $weeks as $week ) {
            $with_homework_amount = $this->lessonRepo->getStudentAmountByPaymentStatusInTeacherGroups(
                Auth::id(),
                $week["start"],
                $week["end"],
                PaymentStatuses::COMPLETE_HOMEWORK);
            $without_homework_amount = $this->lessonRepo->getStudentAmountByPaymentStatusInTeacherGroups(
                Auth::id(),
                $week["start"],
                $week["end"],
                PaymentStatuses::NOT_COMPLETE_HOMEWORK);
            $video_amount = $this->lessonRepo->getStudentAmountByPaymentStatusInTeacherGroups(
                Auth::id(),
                $week["start"],
                $week["end"],
                PaymentStatuses::WATCH_VIDEO);
            $student_amounts = $this->lessonRepo->getStudentAmountInTeacherGroups(Auth::id());

            $revenue = $this->transactionRepo->getSumTransactionsInTeacherGroupsDuringPeriod(Auth::id(), $week["start"] . " 00:00:00", $week["end"] . " 23:59:59");

            $wages = $this->transactionRepo->getWagesInTeacherGroupsDuringPeriod(Auth::id(), $week["start"] . " 00:00:00", $week["end"] . " 23:59:59");

            $premiums = $this->transactionRepo->getTeacherPremium(Auth::id(),$week["start"] . " 00:00:00", $week["end"] . " 23:59:59" );

            $wages_with_premiums = $premiums + $wages;
            $information[] = [
                "name" => Auth::user()->name,
                "home" => $with_homework_amount,
                "without_home" => $without_homework_amount,
                "video" => $video_amount,
                "all" => $student_amounts,
                "revenue" => $revenue,
                "wages" => $wages,
                "premiums" => $premiums,
                "premiums_with_wages" => $wages_with_premiums
            ];
        }
        return $information;
    }

    /**
     *  get all analytic for teacher in month
     * @param string|null $month
     * @param string|null $year
     * @return array
     */
    public function getTeacherAnalyticOnTheMonth (string $month = null, string $year = null): array
    {
        $weeks = DateUtils::getWeeks($month, $year);
        $with_homework_amount = $this->lessonRepo->getStudentAmountByPaymentStatusInTeacherGroups(Auth::id(),
            $weeks[0]["start"],
            $weeks[count($weeks) - 1]["end"],
            PaymentStatuses::COMPLETE_HOMEWORK);

        $without_homework_amount = $this->lessonRepo->getStudentAmountByPaymentStatusInTeacherGroups(Auth::id(),
            $weeks[0]["start"],
            $weeks[count($weeks) - 1]["end"],
            PaymentStatuses::NOT_COMPLETE_HOMEWORK);
        $video_amount =  $this->lessonRepo->getStudentAmountByPaymentStatusInTeacherGroups(Auth::id(),
            $weeks[0]["start"],
            $weeks[count($weeks) - 1]["end"],
            PaymentStatuses::WATCH_VIDEO);
        $student_amounts = $this->lessonRepo->getStudentAmountInTeacherGroups(Auth::id());

        $revenue =$this->transactionRepo->getSumTransactionsInTeacherGroupsDuringPeriod(Auth::id(),
            $weeks[0]["start"],
            $weeks[count($weeks) - 1]["end"]);

        $wages = $this->transactionRepo->getWagesInTeacherGroupsDuringPeriod(Auth::id(),
            $weeks[0]["start"],
            $weeks[count($weeks) - 1]["end"]);

        $premiums = $this->transactionRepo->getTeacherPremium(Auth::id(),
            $weeks[0]["start"] . " 00:00:00",
            $weeks[count($weeks) - 1]["end"] . " 23:59:59");

        $wages_with_premiums = $premiums + $wages;
        return [
            "name" => Auth::user()->name,
            "home" => $with_homework_amount,
            "without_home" => $without_homework_amount,
            "video" => $video_amount,
            "all" => $student_amounts,
            "revenue" => $revenue,
            "wages" => $wages,
            "premiums" => $premiums,
            "premiums_with_wages" => $wages_with_premiums
        ];
    }

    /**
     * get all analytic for every group
     * @param string $month
     * @param string $year
     * @return array
     */
    public function getGroupAnalytic (string $month, string $year): array
    {
        $weeks = DateUtils::getWeeks($month, $year);
        $information = [];
        $teacher_groups = Group::where("teacher_id", Auth::id())->get();
        $ages = [
            1 => "Школьники",
            2 => "Студенты",
            3 => "Взрослые"
        ];
        foreach ( $teacher_groups as $group ) {
            $group_name = $group->name_group;
            $age = $ages[$group->age];
            $year = $group->year;
            $student_amounts = StudentGroups::where("group_id", $group->id)->count();
            $weeks_info = [];
            foreach ( $weeks as $week ) {
                $with_homework_amount = $this->lessonRepo->getStudentsByPaymentsStatusOnLesson($group, $week, PaymentStatuses::COMPLETE_HOMEWORK);
                $without_homework_amount = $this->lessonRepo->getStudentsByPaymentsStatusOnLesson($group, $week, PaymentStatuses::NOT_COMPLETE_HOMEWORK);
                $video_amount = $this->lessonRepo->getStudentsByPaymentsStatusOnLesson($group, $week, PaymentStatuses::WATCH_VIDEO);
                $revenue = $this->transactionRepo->getSumTransactionsOnPeriodInGroup($group, $week["start"], $week["end"]);
                $wages = $this->wagesRepo->getWagesOnPeriodInGroup($group, $week["start"], $week["end"]);
                $weeks_info[] = [
                    "home" => $with_homework_amount,
                    "no_home" => $without_homework_amount,
                    "video" => $video_amount,
                    "revenue" => $revenue,
                    "wages" => $wages,
                ];
            }
            $information[] = [
                "name_group" => $group_name,
                "year" => $year,
                "age" => $age,
                "amount" => $student_amounts,
                "weeks" => $weeks_info
            ];
        }
        return $information;
    }


    /**
     * get all analytic for each teacher in week
     * @param string|null $month
     * @param string|null $year
     * @return array
     */
    public function getTeachersAnalytic (string $month = null, string $year = null): array
    {
        $weeks = DateUtils::getWeeks($month, $year);
        $information = [];
        foreach ( $weeks as $week ) {
            $teachers = User::where("role_id", Roles::TEACHER)->get();
            $teachers_information = [];
            foreach ( $teachers as $teacher ) {
                $with_homework_amount = $this->lessonRepo->getStudentAmountByPaymentStatusInTeacherGroups($teacher->id, $week["start"], $week["end"], PaymentStatuses::COMPLETE_HOMEWORK);
                $without_homework_amount = $this->lessonRepo->getStudentAmountByPaymentStatusInTeacherGroups($teacher->id, $week["start"], $week["end"], PaymentStatuses::NOT_COMPLETE_HOMEWORK);
                $video_amount = $this->lessonRepo->getStudentAmountByPaymentStatusInTeacherGroups($teacher->id, $week["start"], $week["end"], PaymentStatuses::WATCH_VIDEO);
                $student_amounts = $this->lessonRepo->getStudentAmountInTeacherGroups($teacher->id);

                $revenue = $this->transactionRepo->getSumTransactionsInTeacherGroupsDuringPeriod($teacher->id, $week["start"] . " 00:00:00", $week["end"] . " 23:59:59");

                $wages = $this->transactionRepo->getWagesInTeacherGroupsDuringPeriod($teacher->id, $week["start"] . " 00:00:00", $week["end"] . " 23:59:59");

                $premiums = $this->transactionRepo->getTeacherPremium($teacher->id,$week["start"] . " 00:00:00", $week["end"] . " 23:59:59" );

                $wages_with_premiums = $wages + $premiums;

                $teachers_information[] = [
                    "name" => $teacher->name,
                    "home" => $with_homework_amount,
                    "without_home" => $without_homework_amount,
                    "video" => $video_amount,
                    "all" => $student_amounts,
                    "revenue" => $revenue,
                    "wages" => $wages,
                    "premiums" => $premiums,
                    "premiums_with_wages" => $wages_with_premiums,
                    "pribil" => $revenue - $wages_with_premiums
                ];
            }
            $information[] = $teachers_information;
        }
        return $information;
    }

    /**
     * get all analytic for each teacher in month
     * @param string|null $month
     * @param string|null $year
     * @return array
     */
    public function getTeachersAnalyticOnTheMonth (string $month = null, string $year = null): array
    {
        $weeks = DateUtils::getWeeks($month, $year);
        $information = [];
        $teachers = User::where("role_id", Roles::TEACHER)->get();
        foreach ( $teachers as $teacher ) {
            $with_homework_amount = $this->lessonRepo->getStudentAmountByPaymentStatusInTeacherGroups($teacher->id,
                $weeks[0]["start"],
                $weeks[count($weeks) - 1]["end"],
                PaymentStatuses::COMPLETE_HOMEWORK);

            $without_homework_amount = $this->lessonRepo->getStudentAmountByPaymentStatusInTeacherGroups($teacher->id,
                $weeks[0]["start"],
                $weeks[count($weeks) - 1]["end"],
            PaymentStatuses::NOT_COMPLETE_HOMEWORK);
            $video_amount =  $this->lessonRepo->getStudentAmountByPaymentStatusInTeacherGroups($teacher->id,
                $weeks[0]["start"],
                $weeks[count($weeks) - 1]["end"],
                PaymentStatuses::WATCH_VIDEO);
            $student_amounts = $this->lessonRepo->getStudentAmountInTeacherGroups($teacher->id);

            $revenue =$this->transactionRepo->getSumTransactionsInTeacherGroupsDuringPeriod($teacher->id,
                $weeks[0]["start"],
                $weeks[count($weeks) - 1]["end"]);

            $wages = $this->transactionRepo->getWagesInTeacherGroupsDuringPeriod($teacher->id,
                $weeks[0]["start"],
                $weeks[count($weeks) - 1]["end"]);

            $premiums = $this->transactionRepo->getTeacherPremium($teacher->id,
                $weeks[0]["start"] . " 00:00:00",
                $weeks[count($weeks) - 1]["end"] . " 23:59:59");


            $wages_with_premiums = $wages + $premiums;
            $information[] = [
                "name" => $teacher->name,
                "home" => $with_homework_amount,
                "without_home" => $without_homework_amount,
                "video" => $video_amount,
                "all" => $student_amounts,
                "revenue" => $revenue,
                "wages" => $wages,
                "premiums" => $premiums,
                "premiums_with_wages" => $wages_with_premiums,
                "pribil" => $revenue - $wages_with_premiums
            ];
        }
        return $information;
    }

    /**
     * get all information about group
     * @param string $month
     * @param string $year
     * @return array
     */
    public function getGroupsAnalytic (string $month, string $year): array
    {
        $weeks = DateUtils::getWeeks($month, $year);
        $information = [];
        $teachers = User::where("role_id", Roles::TEACHER)->get();
        foreach ( $teachers as $teacher ) {
            $teacher_groups = Group::where("teacher_id", $teacher->id)->get();
            $ages = [
                1 => "Школьники",
                2 => "Студенты",
                3 => "Взрослые"
            ];
            foreach ( $teacher_groups as $group ) {
                $group_name = $group->name_group;
                $age = $ages[$group->age];
                $year = $group->year;
                $student_amounts = StudentGroups::where("group_id", $group->id)->count();
                $weeks_info = [];
                foreach ( $weeks as $week ) {
                    $stats = $this->getDifferentGroupStatsOnPeriod($group, $week);
                    $with_homework_amount = $stats["homework"];
                    $without_homework_amount = $stats["without_homework"];
                    $video_amount = $stats["video"];
                    $revenue = $stats["video"];
                    $wages = $stats["wages"];
                    $weeks_info[] = [
                        "home" => $with_homework_amount,
                        "no_home" => $without_homework_amount,
                        "video" => $video_amount,
                        "revenue" => $revenue,
                        "wages" => $wages,
                    ];
                }
                $information[$teacher->name][] = [
                    "name_group" => $group_name,
                    "year" => $year,
                    "age" => $age,
                    "amount" => $student_amounts,
                    "weeks" => $weeks_info
                ];
            }
        }
        return $information;
    }

    /**
     * get result statistic for special page (week)
     * @param array $weeks
     * @return array
     */
    public function getFinalAnalytic (array $weeks): array
    {
        $information = [];
        $percent = $this->getBankPercent($weeks[0]["start"], $weeks[count($weeks) - 1]["end"]);
        foreach ( $weeks as $week ) {
            $other_payments = $this->transactionRepo->getSumAuxPaymentsOnPeriod($week["start"], $week["end"]);
            $revenue = $this->transactionRepo->getAllTransactions($week['start'], $week['end']);
            $wages = $this->wagesRepo->getWagesOnPeriod($week["start"], $week["end"]);
            $premiums = $this->premiumRepo->getSumPremiumOnPeriod($week["start"], $week["end"]);

            $wages_with_premiums = $premiums + $wages;
            $revenue_with_percent = $revenue * (1 - $percent / 100);
            $information[] = [
                "revenue" => $revenue,
                "wages" => $wages,
                "percent" => $percent,
                "premiums" => $premiums,
                "wages_with_premiums" => $wages_with_premiums,
                "other_payments" => $other_payments,
                "revenue_with_percent" => $revenue_with_percent,
                "income" => $revenue_with_percent - $wages_with_premiums - $other_payments
            ];
        }
        return $information;
    }

    /**
     * get result statistic for special page (month)
     * @param array $weeks
     * @return array
     */
    public function getFinalAnalyticOnTheMonth (array $weeks): array
    {
        $revenue = $this->transactionRepo->getSumTransactionsDuringPeriod($weeks[0]["start"], $weeks[count($weeks) - 1]["end"]);
        $wages = $this->wagesRepo->getWagesOnPeriod($weeks[0]["start"], $weeks[count($weeks) - 1]["end"]);
        $percent = $this->getBankPercent($weeks[0]["start"], $weeks[count($weeks) - 1]["end"]);
        $premiums = $this->premiumRepo->getSumPremiumOnPeriod($weeks[0]["start"], $weeks[count($weeks) - 1]["end"]);

        $wages_with_premiums = $premiums + $wages;
        $other_payments = $this->transactionRepo->getSumAuxPaymentsOnPeriod($weeks[0]["start"], $weeks[count($weeks) - 1]["end"]);
        $revenue_with_percent = $revenue * (1 - $percent / 100);
        return [
            "revenue" => $revenue,
            "wages" => $wages,
            "percent" => $percent,
            "premiums" => $premiums,
            "wages_with_premiums" => $wages_with_premiums,
            "other_payments" => $other_payments,
            "revenue_with_percent" => $revenue_with_percent,
            "income" => $revenue_with_percent - $wages_with_premiums - $other_payments
        ];
    }


    public function getBankPercent (string $start, string $end)
    {
        $percent = DB::table("bank_percents")->where([
                [
                    "date",
                    ">=",
                    $start
                ],
                [
                    "date",
                    "<=",
                    $end
                ]
            ])->first()->percent ?? 0;
        return $percent;
    }

    /**
     * @param  $group
     * @param  $period
     * @return array
     */
    private function getDifferentGroupStatsOnPeriod ($group, $period): array
    {
        $with_homework_amount = $this->lessonRepo->getStudentsByPaymentsStatusOnLesson($group, $period, PaymentStatuses::COMPLETE_HOMEWORK);
        $without_homework_amount = $this->lessonRepo->getStudentsByPaymentsStatusOnLesson($group, $period, PaymentStatuses::NOT_COMPLETE_HOMEWORK);
        $video_amount = $this->lessonRepo->getStudentsByPaymentsStatusOnLesson($group, $period, PaymentStatuses::WATCH_VIDEO);
        $revenue = $this->transactionRepo->getSumTransactionsOnPeriodInGroup($group, $period["start"], $period["end"]);
        $wages = $this->wagesRepo->getWagesOnPeriodInGroup($group, $period["start"], $period["end"]);

        return [
            "homework" => $with_homework_amount,
            "without_homework" => $without_homework_amount,
            "video" => $video_amount,
            "revenue" => $revenue,
            "wages" => $wages
        ];
    }
}