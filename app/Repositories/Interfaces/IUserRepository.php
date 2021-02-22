<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface IUserRepository
{
    public function updateTeacher (string $id, $requestBody);

    public function create ($request);

    public function getUserByRoleId ($role_id): Collection;

    public function updatePassword (int $id, $requestBody): void;


    public function updateDirector ($id, $requestBody): void;

    public function getUserVKByName (string $name);

    public function getBirthdays ();

    public function getAllInformationAboutStudent ($id);

    public function getUserById ($id);

    public function getTeachers ();

    public function getStudents ();

    public function getAdmins ();
}