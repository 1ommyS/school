<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Premium;
use App\Models\User;

class PremiumsController extends Controller
{
    public function get ()
    {
        return Premium::all()->map(function ($el) {
            $el->key = $el->id;
            $el->name = User::where("id", $el->teacher_id)->first()->name;
            return $el;
        });
    }

    public function change (int $id)
    {
        $decode_request = json_decode(file_get_contents("php://input"));
        Premium::where("id", $id)->update(["value" => $decode_request->value]);
    }

    public function delete (int $id)
    {
     Premium::where("id", $id)->delete();
    }
}
