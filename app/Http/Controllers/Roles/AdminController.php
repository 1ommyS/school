<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use App\Models\{Admin, Kicked, Percent, Premium, Wages};
use App\Repositories\Implementations\{GroupRepository, LogRepository, TransactionsRepository, UserRepository};
use App\Services\Implementations\{AnalyticService, RequestValidationService};
use App\utils\{DateUtils};
use Illuminate\Http\{RedirectResponse, Request};
use Illuminate\Support\Facades\{Auth, Validator};

class AdminController extends Controller
{

    private UserRepository $repository;
    private AnalyticService $service;
    private GroupRepository $groupRepo;
    private TransactionsRepository $transactionRepo;
    private RequestValidationService $requestValidationService;

    /**
     * WagesController constructor.
     */
    public function __construct ()
    {
        $this->model = new Wages();
        $this->repository = new UserRepository();
        $this->groupRepo = new GroupRepository();
        $this->transactionRepo = new TransactionsRepository();
        $this->service = new AnalyticService();
        $this->requestValidationService = new RequestValidationService();
    }

    /**
     * GET: /profile/
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show (Request $request)
    {

        $month = $request->month ?? date("m");
        $year = $request->year ?? date("Y");

        $information = $this->service->getTeachersAnalytic($month, $year);
        $information_on_the_month = $this->service->getTeachersAnalyticOnTheMonth($month, $year);
        $weeks = DateUtils::getWeeks($month, $year);
        $groups = $this->service->getGroupsAnalytic($month, $year);
        return view("pages.admin.index", [
            "month" => $month,
            "year" => $year,
            "information" => $information,
            "weeks" => $weeks,
            "information_on_the_month" => $information_on_the_month,
            "groups" => $groups,
        ]);
    }

    /**
     * GET: /profile/settings
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function settingsPage (Request $request)
    {
        return view("pages.admin.settings");
    }


    /**
     * store new info about director
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store (Request $request)
    {
        $rules = [
            "login" => "required",
            "password" => "required",
            "name" => "required",
            "link_vk" => "required",
        ];
        $messages = [
            "name.required" => "Укажите своё имя",
            "login.unique" => "Такой пользователь уже есть",
            "password.required" => "Укажите свой пароль",
            "login.required" => "Укажите свой логин",
            "link_vk.required" => "Укажите свой VK",
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();
        $this->repository->updateDirector(Auth::id(), $request);

        session()->flash("success", "Вы успешно обновили свои данные");
        return redirect()->back();

    }


    /**
     * GET: /profile/all
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function all (Request $request)
    {
        [
            $month,
            $year
        ] = $this->requestValidationService->defineMethodAndYear($request);

        $weeks = DateUtils::getWeeks($month, $year);
        $information = $this->service->getFinalAnalytic($weeks);
        $month_info = $this->service->getFinalAnalyticOnTheMonth($weeks);
        return view("pages.admin.all", [
            "month" => $month,
            "year" => $year,
            "weeks" => $weeks,
            "information" => $information,
            "month_info" => $month_info,
        ]);

    }

    public function period (Request $request)
    {
        if ( empty($request->all()) )
            return view("pages.admin.period", ["show" => false, "information" => [], "period" => []]);

        $request_format = $this->requestValidationService->definePeriod($request->day_start, $request->day_finish);
        $weeks = $request_format["weeks"];
        $start = $request_format["first"];
        $finish = $request_format["last"];
        $information = $this->service->getFinalAnalytic($weeks);
        $period = $this->service->getFinalAnalyticOnTheMonth($weeks);
        return view("pages.admin.period", compact("start", "finish", "information", "period", "weeks"));

    }

    /**
     * page where you can see all information about student (lessons, info, transactions)
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function studentinfoPage (Request $request, $id)
    {

        $information = $this->repository->getAllInformationAboutStudent($id);

        $ages = [

            1 => "Школьник",

            2 => "Студент",

            3 => "Взрослый",

        ];

        $formats = [

            "1" => "Выполнял ДЗ",

            "2" => "Не выполнял ДЗ",

            "3" => "Смотрел видео"

        ];

        return view("pages.admin.student_information", compact("information", "ages", "formats"));

    }

    /**
     * list of kicked from groups student
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function kicked (Request $request)
    {

        $students = Kicked::getKickedStudents();

        return view("pages.admin.kicked", compact("students"));

    }

    /**
     * table auxil payments
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function auxils (Request $request)
    {
        [
            $month,
            $year
        ] = $this->requestValidationService->defineMethodAndYear($request);

        $weeks = DateUtils::getWeeks($month, $year);
        $auxils = $this->transactionRepo->getAuxilsOnWeeks($weeks);
        $aux_month = $this->transactionRepo->getAuxilsDuringPeriod($weeks[0]["start"], $weeks[count($weeks) - 1]["end"]);

        return view("pages.admin.auxils", [
            "month" => $month,
            "year" => $year,
            "weeks" => $weeks,
            "auxils" => $auxils,
            "auxils_month" => $aux_month,
        ]);
    }

    /**
     * page where you can set percent
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function percentPage ()
    {
        return view("pages.admin.percent");
    }

    /**
     * store percent
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function percent (Request $request): RedirectResponse
    {
        Percent::create([
            "date" => $request->date,
            "percent" => str_replace(",", ".", $request->value),
        ]);

        session()->flash("success", "Банковский процесс успешно установлен: " . $request->value . " %");
        return redirect()->back();
    }

    /**
     * page where you can add auxil payment
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function addauxilPage ()
    {
        return view("pages.admin.addauxil");
    }

    /**
     * save aux payment
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addauxil (Request $request)
    {
        Admin::addAuxilPayment($request);

        session()->flash("success", "Платеж успешно добавлен");

        return redirect()->back();

    }

    /**
     * page with students table
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function students (Request $request)
    {

        $students = $this->repository->getStudents();

        $ages = [
            1 => "Школьник",
            2 => "Студент",
            3 => "Взрослый",
        ];

        return view("pages.admin.students", compact("students", "ages"));

    }

    /**
     * page with birthdays table
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function birthdays ()
    {
        $birthdays = $this->repository->getBirthdays();

        $aliases = [
            "01" => "Январь",
            "02" => "Февраль",
            "03" => "Март",
            "04" => "Апрель",
            "05" => "Май",
            "06" => "Июнь",
            "07" => "Июль",
            "08" => "Август",
            "09" => "Сентябрь",
            "10" => "Октябрь",
            "11" => "Ноябрь",
            "12" => "Декабрь"
        ];
        return view("pages.admin.birthdays", compact("birthdays", "aliases"));
    }

    /**
     * page where you can send message to everybody/somebody
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function sendingPage (Request $request)
    {
        $students = $this->repository->getUserByRoleId(Auth::user()->role_id);
        return view("pages.admin.sending", compact("students"));
    }

    /**
     * send messages
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function sending (Request $request)
    {
        $users = [];
        return view("pages.admin.sended", compact("users"));
    }


    /**
     * page where you can change student pass
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function passwordPage (Request $request, $id)
    {
        $name = $this->repository->getUserById($id)->name;
        $login = $this->repository->getUserById($id)->login;

        return view("pages.admin.password", compact("name", "login"));

    }

    /**
     * save new password
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password (Request $request, $id)
    {

        $this->repository->updatePassword($id, $request);


        session()->flash("success", "Пароль успешно обновлён");

        return redirect()->back();
    }

    /**
     * page where you can give premium
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function premiumPage (Request $request, $id)
    {

        $name = $this->repository->getUserById($id)->name;

        return view("pages.admin.premium", compact("name"));

    }

    /**
     * store premium
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function premium (Request $request, $id)
    {

        Premium::addPremium($request, $id);

        session()->flash("success", "Премия выдана");

        return redirect()->back();

    }

    /**
     * page with groups table
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function groups (Request $request)
    {

        $groups_info = $this->groupRepo->getInfoAboutGroups();

        return view("pages.admin.groups", compact("groups_info"));

    }

    /**
     * page with all logs
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function logs ()
    {
        return view("pages.admin.logs", ["logs" => LogRepository::getAllLogs()]);
    }

    /**
     * page with teachers table
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function teachers (Request $request)
    {

        $teachers = $this->repository->getTeachers();

        return view("pages.admin.teachers", compact("teachers"));

    }

}
