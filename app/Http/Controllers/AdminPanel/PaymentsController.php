<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\AuxPayments;

class PaymentsController extends Controller
{
    public function get ()
    {
        return AuxPayments::all();
    }

    public function change (int $id)
    {
        $decode_request = json_decode(file_get_contents("php://input"));
        AuxPayments::where("id", $id)->update(["value" => $decode_request->value]);
    }

    public function delete (int $id)
    {
        AuxPayments::where("id", $id)->delete();
    }
}
