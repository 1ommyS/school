<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface IStudentRepository
{
    public function kickStudents ($request, $group_id);
    public function getFreeStudents ($group_id);
    public function getStudentIdByGroupId ($group_id);
    public function saveStudent (int $student_id, Request $request_data): void;
}