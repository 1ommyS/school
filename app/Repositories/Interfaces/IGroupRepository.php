<?php

namespace App\Repositories\Interfaces;

interface IGroupRepository
{
    public function findGroupById (string $id);

    public function getGroupName (string $id);

    public function getStudentsDataInGroup (string $group_id);
}