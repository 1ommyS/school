<?php

namespace App\Repositories\Interfaces;

interface ILessonRepository
{
    /**
     * @param $group_id
     * @return array
     */
    public function getLessonsDates ($group_id);

    /**
     * @param $group_id
     * @param $date
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function getLessonInformation ($group_id, $date);

    /**
     * @param int $student_id
     * @param string $attended_type
     * @param $request
     * @param $group_id
     * @param $lesson_number
     */
    public function addLesson (int $student_id, string $attended_type, $request, $group_id, $lesson_number);

    /**
     * @param $group_id
     * @return int|mixed
     */
    public function getLessonNumber ($group_id);

    /**
     * @param $information
     * @param $group_id
     * @param $date
     */
    public function editLesson ($information, $group_id, $date);

    /**
     * @param $group_id
     * @param $date
     * @return array
     */
    public function getInformationAboutStudentsOnLesson ($group_id, $date);

    /**
     * @param $teacher_id
     * @param string $start
     * @param string $end
     * @param int $payment_status
     * @return int
     */
    public function getStudentAmountByPaymentStatusInTeacherGroups ($teacher_id, string $start, string $end, int $payment_status);

    /**
     * @param $teacher_id
     * @return int
     */
    public function getStudentAmountInTeacherGroups ($teacher_id);

    /**
     * @param $group
     * @param array $week
     * @param $payment_status
     * @return int
     */
    public function getStudentsByPaymentsStatusOnLesson ($group, array $week, $payment_status): int;
}