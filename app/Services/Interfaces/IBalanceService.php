<?php

namespace App\Services\Interfaces;

interface IBalanceService {
    public function updateBalance (int $payment_amount, string $id, $user_id): string;
}