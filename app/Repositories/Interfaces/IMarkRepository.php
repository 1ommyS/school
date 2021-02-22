<?php


namespace App\Repositories\Interfaces;


use Illuminate\Database\Eloquent\Collection;

interface IMarkRepository
{
    public function saveStudentMark(int $student_id, int $group_id, int $mark, $date): void;
    public function getStudentMarks(int $student_id, int $group_id): Collection;
    public function getStudentMarkOnTheDate(int $student_id, int $group_id, $date): Collection;
    public function getStudentMarkDuringThePeriod(int $student_id, int $group_id, $first_day, $last_day): Collection;

}