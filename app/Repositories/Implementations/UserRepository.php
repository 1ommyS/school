<?php


namespace App\Repositories\Implementations;


use App\Enums\Roles;
use App\Models\Group;
use App\Models\StudentGroups;
use App\Models\User;
use App\Repositories\Interfaces\IUserRepository;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class UserRepository implements IUserRepository
{
    private Group $group;

    public function __construct ()
    {
        $this->group = new Group();
    }

    public function updateTeacher (string $id, $requestBody)
    {
        $user = User::find($id);
        $user->name = $requestBody->name;
        $user->login = $requestBody->login;
        $user->password = hash('sha3-256', $requestBody->password);
        $user->phone_teacher = $requestBody->phone_teacher;
        $user->link_vk = $requestBody->link_vk;

       $user->save();

    }

    public function create ($request)
    {
        return User::create([
            'name' => $request->name,
            'login' => $request->login,
            'city' => $request->city,
            'age' => $request->age,
            'phone_student' => $request->phone_student,
            'phone_parent' => $request->phone_parent,
            'birthday' => $request->birthday,
            'link_vk' => $request->link_vk,
            'name_parent' => $request->name_parent,
            'password' => hash("sha3-256", $request->password),
            'parent_vk' => $request->parent_vk,
            'role_id' => Roles::STUDENT
        ]);
    }

    public function getUserByRoleId ($role_id): Collection
    {
        return User::where("role_id", Roles::STUDENT)->get();
    }

    public function updatePassword (int $id, $requestBody): void
    {
       $user = User::where('id', $id)->first();
        $user->password = hash('sha3-256', $requestBody->password);
        $user->save();
    }

    public function updateDirector ($id, $requestBody): void
    {
        $user = User::find($id);
        $user->name = $requestBody->name;


        $user->login = $requestBody->login;


        $user->password = hash('sha3-256', $requestBody->password);


        $user->link_vk = $requestBody->link_vk;


        $user->save();


    }

    public function getUserVKByName (string $name)
    {

        return User::where("name", str_replace("%20", " ", $name))->first()->link_vk;

    }

    public function getBirthdays ()
    {
        $users = User::select("name", "birthday", "link_vk")->where("role_id", Roles::STUDENT)->orderBy("birthday")->get();

        $birthdays = [
            "01" => [],
            "02" => [],
            "03" => [],
            "04" => [],
            "05" => [],
            "06" => [],
            "07" => [],
            "08" => [],
            "09" => [],
            "10" => [],
            "11" => [],
            "12" => [],
        ];
        foreach ( $users as $index => $user ) {
            $birthday_month = (string) explode("-", $user->birthday)[1];
            $birthdays[$birthday_month][] = [
                "name" => $user->name,
                "link_vk" => $user->link_vk,
                "birthday" => date("d.m.Y", strtotime($user->birthday))
            ];
        }
        // TODO: ещё один форич по месяцам, и там usort и сортирую как на скрине прям, ток по дню
        foreach ( $birthdays as $month => $birthday_date ) {
            usort($birthdays[$month], function ($a, $b) {
                if ((int) (explode(".", $a["birthday"]))[0] > (int) (explode(".", $b["birthday"]))[0]) return 1;
                if ((int) (explode(".", $a["birthday"]))[0] > (int) (explode(".", $b["birthday"]))[0]) return 0;
                if ((int) (explode(".", $a["birthday"]))[0] > (int) (explode(".", $b["birthday"]))[0]) return -1;
            });
        }
        return $birthdays;
    }

    public function getAllInformationAboutStudent ($id)
    {

        $transactions = $this->getAllStudentPayments($id);


        $lessons = $this->getAllStudentLessons($id);


        $information = $this->getUserById($id);


        return [

            "transactions" => $transactions,

            "lessons" => $lessons,

            "information" => $information

        ];

    }

    private function getAllStudentPayments ($id)
    {
        $transactions = DB::table("transactions")->select()->orderBy("date_transaction")->where("student_id", $id)->get();
        foreach ( $transactions as $index => $transaction ) {
            $transactions[$index]->group_name = DB::table("groups")->where("id", $transaction->group_id)->first()->name_group;
        }
        return $transactions;
    }

    private function getAllStudentLessons ($id)
    {

        $lessons = DB::table("student_lessons")->orderBy("date")->where("student_id", $id)->get();

        foreach ( $lessons as $index => $lesson ) {

            try {

                $lessons[$index]->group_name = DB::table("groups")->where("id", $lesson->group_id)->first()->name_group;

            } catch ( Exception $e ) {

                $lessons[$index]->group_name = "Группа удалена";

            }

        }

        return $lessons;

    }

    public function getUserById ($id)
    {
        return User::where('id', $id)->first();
    }

    public function getTeachers ()
    {
        return User::where("role_id", Roles::TEACHER)->get();
    }

    public function getStudents ()
    {
        return User::where("role_id", Roles::STUDENT)->get();
    }

    public function getAdmins ()
    {
        return DB::table("admin")->get();
    }

    public function delete (int $id)
    {
        User::where("id", $id)->delete();
    }

    public function setBalance (int $value, int $student_id, int $group_id)
    {
        $row =   StudentGroups::where([["student_id", $student_id], ["group_id", $group_id]])->first();
        $row->balance = $value;
        $row->save();
    }

    public function setBonuses (int $value, int $student_id, int $group_id)
    {
        $row = StudentGroups::where([["student_id", $student_id], ["group_id", $group_id]])->first();
        $row->count_bonus_lessons = $value;
        $row->save();
    }

}