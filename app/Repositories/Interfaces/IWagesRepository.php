<?php

namespace App\Repositories\Interfaces;

interface IWagesRepository
{
    public function getWagesOnPeriod (string $start, string $end): float;

    public function getWagesOnPeriodInGroup ($group, string $start, string $end): float;
}