<?php

namespace App\Services\Interfaces;

interface IAnalyticService
{
    /**
     *  get all analytic for teacher in week
     * @param string|null $month
     * @param string|null $year
     * @return array
     */
    public function getTeacherAnalytic (string $month = null, string $year = null): array;

    /**
     *  get all analytic for teacher in month
     * @param string|null $month
     * @param string|null $year
     * @return array
     */
    public function getTeacherAnalyticOnTheMonth (string $month = null, string $year = null): array;

    /**
     * get all analytic for every group
     * @param string $month
     * @param string $year
     * @return array
     */
    public function getGroupAnalytic (string $month, string $year): array;

    /**
     * get all analytic for each teacher in week
     * @param string|null $month
     * @param string|null $year
     * @return array
     */
    public function getTeachersAnalytic (string $month = null, string $year = null): array;

    /**
     * get all analytic for each teacher in month
     * @param string|null $month
     * @param string|null $year
     * @return array
     */
    public function getTeachersAnalyticOnTheMonth (string $month = null, string $year = null): array;

    /**
     * get all information about group
     * @param string $month
     * @param string $year
     * @return array
     */
    public function getGroupsAnalytic (string $month, string $year): array;

    /**
     * get result statistic for special page (week)
     * @param array $weeks
     * @return array
     */
    public function getFinalAnalytic (array $weeks): array;

    /**
     * get result statistic for special page (month)
     * @param array $weeks
     * @return array
     */
    public function getFinalAnalyticOnTheMonth (array $weeks): array;

    public function getBankPercent (string $start, string $end);
}