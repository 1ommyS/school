<?php

namespace App\Repositories\Interfaces;

interface ITransactionsRepository
{
    public function getAuxilsOnWeeks (array $weeks): array;

    public function getAuxilsDuringPeriod (string $start, string $end);

    public function getSumTransactionsInTeacherGroupsDuringPeriod ($teacher_id, string $start, string $end);

    public function getWagesInTeacherGroupsDuringPeriod ($teacher_id, string $start, string $end);

    public function getTeacherPremium ($teacher_id, string $start, string $end);

    public function getSumTransactionsDuringPeriod (string $start, string $end);

    public function getSumTransactionsOnPeriodInGroup ($group, string $start, string $end);

    /**
     * get all transaction in system on time period
     * @param string $start
     * @param string $end
     * @return int
     */
    public function getAllTransactions (string $start, string $end): int;

    /**
     * @param string $start
     * @param string $end
     * @return int
     */
    public function getSumAuxPaymentsOnPeriod (string $start, string $end): int;
}