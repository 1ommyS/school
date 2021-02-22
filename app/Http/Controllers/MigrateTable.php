<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Log;
use App\Models\User;
use App\utils\FormatUtils;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class MigrateTable extends Controller
{
    /*public function handle()
    {
        try {
            $logs = Log::all();
            foreach ( $logs as $l ) {
                try {
                    DB::table("logs1")->insert(
                        [
                            "user_id" => User::where("name", FormatUtils::UrlDecode($l->username))->first()->id,
                            "group_id" => Group::where("name_group", FormatUtils::UrlDecode($l->groupname))->first()->id,
                            "lesson_number" => $l->lesson_id ? $l->lesson_id : 0,
                            "type" => $l->type,
                            "balance_before_transaction" => $l->oldbalance,
                            "balance_after_transaction" => $l->newbalance,
                            "lesson_cost" => $l->lessoncost,
                            "vk" => $l->vk,
                            "message" => FormatUtils::UrlDecode($l->message),
                            "status" => $l->status,
                            "created_at" => $l->created_at
                        ]
                    );
                } catch (\Exception $e) {
                }
            }
            } catch (Exception $e) {

        }
        return "все ок";
    }*/
}