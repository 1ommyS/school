<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface IStudentGroupsRepository
{
    public function getByStudentId (int $id): Collection;

    public function getGroupsInformation ($student_groups): array;
}