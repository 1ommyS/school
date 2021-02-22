<?php

namespace App\Providers;

use App\Repositories\Implementations\GroupRepository;
use App\Repositories\Implementations\LessonRepository;
use App\Repositories\Implementations\StudentGroupsRepository;
use App\Repositories\Implementations\TransactionsRepository;
use App\Repositories\Implementations\UserRepository;
use App\Repositories\Interfaces\IGroupRepository;
use App\Repositories\Interfaces\ILessonRepository;
use App\Repositories\Interfaces\IStudentGroupsRepository;
use App\Repositories\Interfaces\ITransactionsRepository;
use App\Repositories\Interfaces\IUserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            IUserRepository::class,
            UserRepository::class
        );
        //$this->app->bind(
        //    IGroupRepository::class,
        //    GroupRepository::class
        //);
        //$this->app->bind(
        //    ITransactionsRepository::class,
        //    TransactionsRepository::class
        //);
        //$this->app->bind(
        //    ILessonRepository::class,
        //    LessonRepository::class
        //);
        //$this->app->bind(
        //    IStudentGroupsRepository::class,
        //    StudentGroupsRepository::class
        //);
        //$this->app->bind(
        //    IGroupRepository::class,
        //    GroupRepository::class
        //);
    }
}
