<?php


namespace App\Http\Controllers;


use App\Http\Controllers\Roles\AdminController;
use App\Http\Controllers\Roles\IRoleController;
use App\Http\Controllers\Roles\StudentController;
use App\Http\Controllers\Roles\TeacherController;
use App\Models\Birthday;
use App\Services\Implementations\BirthdayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{

    private array $roles_controllers;
    private BirthdayService $service;

    /**
     * RoleController constructor.
     */

    public function __construct ()
    {
        $this->roles_controllers = [
            1 => new StudentController(),
            2 => new TeacherController(),
            3 => new AdminController()
        ];
        $this->service = new BirthdayService();

    }

    public function defineRole (Request $request)
    {
        return $this->roles_controllers[Auth::user()->role_id]->show($request);
    }


    public function settingsPage (Request $request)
    {
        return $this->roles_controllers[Auth::user()->role_id]->settingsPage($request);
    }


    public function store (Request $request)
    {
        return $this->roles_controllers[Auth::user()->role_id]->store($request);
    }
}