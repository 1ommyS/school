<?php

namespace App\Repositories\Interfaces;

interface ILogRepository
{
    /**
     * @return \App\Models\Log[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getAllLogs ();
}