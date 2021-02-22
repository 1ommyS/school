<?php

namespace App\Repositories\Interfaces;

interface IPremiumRepository
{
    public function getSumPremiumOnPeriodForTeacher ($teacher_id, string $start, string $end): int;

    public function getSumPremiumOnPeriod (string $start, string $end): int;
}