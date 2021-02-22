<?php

use App\Http\Controllers\{AdminPanel\PageController,
    AdminPanel\PaymentsController,
    AdminPanel\PremiumsController,
    AdminPanel\StudentsController,
    Landing\LandingController,
    MailController,
    MigrateTable,
    RoleController,
    Roles\AdminController,
    Roles\GroupController,
    Roles\LessonController,
    Roles\StudentController,
    Roles\TeacherController,
    Roles\WagesController,
    UserController};
use Illuminate\Support\Facades\Route;

// auth forms
Route::get('/', function () {
    return view('auth.login');
})->name("login")->middleware('guest');
Route::get('/signup', function () {
    return view('auth.signup');
})->name("signup")->middleware('guest');

Route::post('/', [
    UserController::class,
    "auth"
])->name('auth.login');
Route::post('/signup', [
    UserController::class,
    "create"
])->name('auth.create');
Route::get('/logout', [
    UserController::class,
    "logout"
]);

Route::group(['middleware' => 'authenticated'], function () {
    Route::get("/group/{group_id}", [
        GroupController::class,
        "index"
    ]);
    Route::get("/group/addlesson/{group_id}", [
        LessonController::class,
        "addlessonForm"
    ]);

    Route::get("/group/lesson/{group_id}/{date}", [
        LessonController::class,
        "lessonForm"
    ]);
    Route::post("/group/addlesson/{group_id}", [
        LessonController::class,
        "addlesson"
    ]);
    Route::post("/group/lesson/{group_id}/{date}", [
        LessonController::class,
        "editlesson"
    ]);

    Route::post("/group/payment/{student_id}/{group_id}", [
        GroupController::class,
        "addpayment"
    ]);
    Route::post("/group/bonus/{student_id}/{group_id}", [
        GroupController::class,
        "addbonus"
    ]);

    Route::get('/group/delete/{student_id}/{group_id}', [
        GroupController::class,
        "deleteStudent"
    ]);
    Route::get('/group/exempt/{student_id}/{group_id}', [
        GroupController::class,
        "exempt"
    ]);
    Route::get('/group/offexempt/{student_id}/{group_id}', [
        GroupController::class,
        "offexempt"
    ]);

    Route::get('/mystudents/{id}', [
        GroupController::class,
        "students"
    ]);

    Route::get("/archive/{group_id}", [
        GroupController::class,
        "archive"
    ]);
});
Route::group(["prefix" => "/profile"], function () {
    Route::get('/student/{student_id}/{group_id}', [
        GroupController::class,
        "student"
    ]);
    Route::match([
        'get',
        'post'
    ], '/', [
        RoleController::class,
        "defineRole"
    ])->name('profile')->middleware('authenticated');
    Route::get('/settings', [
        RoleController::class,
        "settingsPage"
    ])->name('profile.update')->middleware('authenticated');
    Route::post('/settings', [
        RoleController::class,
        "store"
    ])->name('profile.save')->middleware('authenticated');

    // store payment
    Route::match([
        "GET",
        "POST",
        "PUT",
        "PATCH",
        "DELETE"
    ], '/access/{id}', [
        StudentController::class,
        "storePayment"
    ]);
    Route::match(["GET", "POST"],"marks/api/{id}", [
        StudentController::class,
        "marks"
    ]);

    Route::match(["GET", "POST"],"marks/{id}", [
        StudentController::class,
        "marksView"
    ]);
    Route::get("/marks/{id}/clear", [
        StudentController::class,
        "delete"
    ]);
    // main section
    Route::group(['middleware' => 'is_student'], function () {
        Route::get('/pay/{id}', [
            StudentController::class,
            "payPage"
        ])->name('student.pay');
        Route::post('/pay/{id}', [
            StudentController::class,
            "save"
        ])->name('student.storepay');

        Route::get('/history/{id}', [
            StudentController::class,
            "history"
        ])->name('student.history');
        Route::get('/payments/{id}', [
            StudentController::class,
            "payments"
        ])->name('student.payments');


    });
    Route::group(['middleware' => 'is_teacher'], function () {
        Route::get("/addgroup", [
            TeacherController::class,
            "groupForm"
        ]);
        Route::post("/addgroup", [
            TeacherController::class,
            "group"
        ]);

        Route::get("/editgroup/{group_id}", [
            TeacherController::class,
            "editPage"
        ]);
        Route::post("/editgroup/{group_id}", [
            TeacherController::class,
            "edit"
        ]);

        Route::get("/addstudent/{group_id}", [
            TeacherController::class,
            "addstudentPage"
        ]);
        Route::post("/addstudent/{group_id}", [
            TeacherController::class,
            "saveNewStudent"
        ]);

    });
    Route::group(['middleware' => 'is_admin'], function () {
        Route::match([
            'get',
            'post'
        ], '/all', [
            AdminController::class,
            "all"
        ]);

        Route::get('/setpercent', [
            AdminController::class,
            "percentPage"
        ]);
        Route::post('/setpercent', [
            AdminController::class,
            "percent"
        ]);

        Route::get('/teachers', [
            AdminController::class,
            "teachers"
        ]);
        Route::get('/students', [
            AdminController::class,
            "students"
        ]);
        Route::get('/groups', [
            AdminController::class,
            "groups"
        ]);
        Route::get('/sending', [
            AdminController::class,
            "sendingPage"
        ]);
        Route::post('/sending', [
            AdminController::class,
            "sending"
        ]);

        Route::get('/addteacher', [
            AdminController::class,
            "addteacherPage"
        ]);
        Route::post('/addteacher', [
            AdminController::class,
            "addteacher"
        ]);

        Route::get('/premium/{id}', [
            AdminController::class,
            "premiumPage"
        ]);
        Route::post('/premium/{id}', [
            AdminController::class,
            "premium"
        ]);

        Route::get('/password/{id}', [
            AdminController::class,
            "passwordPage"
        ]);
        Route::post('/password/{id}', [
            AdminController::class,
            "password"
        ]);

        Route::get("/kicked", [
            AdminController::class,
            "kicked"
        ]);
        Route::get('/studentinfo/{id}', [
            AdminController::class,
            "studentinfoPage"
        ]);

        Route::get('/auxil', [
            AdminController::class,
            "auxils"
        ]);
        Route::post('/auxil', [
            AdminController::class,
            "auxils"
        ]);

        Route::get("/logs", [
            AdminController::class,
            "logs"
        ]);
        Route::get("/birthdays", [
            AdminController::class,
            "birthdays"
        ]);

        Route::get('/addauxil', [
            AdminController::class,
            "addauxilPage"
        ]);
        Route::post('/addauxil', [
            AdminController::class,
            "addauxil"
        ]);

        Route::match([
            'get',
            'post'
        ], '/period', [
            AdminController::class,
            "period"
        ]);
    });


    Route::match([
        'get',
        'post'
    ], "/wages", [
        WagesController::class,
        "teacher"
    ])->middleware("is_teacher");

});
Route::delete("/api/v1/student/{id}", [
    StudentsController::class,
    "delete"
]);

Route::get("/api/v1/students", [
    StudentsController::class,
    "students"
]);
Route::get("/api/v1/{id}/groups",[
    StudentsController::class,
    "freeGroups"
]);
Route::get("/api/v1/groups",[
    StudentsController::class,
    "groups"
]);


Route::get("/api/v1/{id}/groups", [
    StudentsController::class,
    "studentGroups"
]);
Route::get("/api/v1/groups/{id}/{student_id}",[
    StudentsController::class,
    "groupInformation"
]);
Route::post("/api/v1/{student_id}/{group_id}/update", [
    StudentsController::class,
    "updateStudentInformation"
]);
Route::get("/api/v1/premiums",[PremiumsController::class, "get"]);
Route::post("/api/v1/premiums/{id}",[PremiumsController::class, "change"]);
Route::delete("/api/v1/premiums/{id}",[PremiumsController::class, "delete"]);

Route::get("/api/v1/payments",[PaymentsController::class, "get"]);
Route::post("/api/v1/payments/{id}",[PaymentsController::class, "change"]);
Route::delete("/api/v1/payments/{id}",[PaymentsController::class, "delete"]);

Route::group(["prefix" => "/panel", "middleware" => "is_admin"], function () {
    Route::get("/{slug?}/{slug2?}/{slug3?}", [
        PageController::class,
        "index"
    ]);

});

// settings page

Route::get("/migrate", [
    MigrateTable::class,
    "handle"
]);


Route::get('/group/{id}', [
    GroupController::class,
    "index"
])->name('group');

Route::fallback(function () {
    abort('404');
});