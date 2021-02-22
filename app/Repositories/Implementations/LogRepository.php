<?php

namespace App\Repositories\Implementations;

use App\Models\Group;
use App\Models\User;
use App\Repositories\Interfaces\ILogRepository;
use Carbon\Carbon;

class LogRepository implements ILogRepository
{

    public static function getAllLogs ()
    {
        $user = new UserRepository();
        $group = new GroupRepository();
        $logs = (new \App\Models\Log)->select("*")->orderBy("id", "desc")->get();
        foreach ( $logs as $i => $log ) {

            $logs[$i]["username"] = $user->getUserById($log->user_id)->name;
            $logs[$i]["groupname"] = $group->getGroupName($log->group_id);
            $logs[$i]["teacher_name"] = User::where("id", Group::where("id", $log->group_id)->first()->teacher_id)->first()->name;
            $logs[$i]["teacher_id"] = User::where("id", Group::where("id", $log->group_id)->first()->teacher_id)->first()->id;
            $logs[$i]["human_created_date"] = Carbon::parse($log->created_at)->diffForHumans();
        }
        return $logs;
    }
}
