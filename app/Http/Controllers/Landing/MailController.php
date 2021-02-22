<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailController extends Controller
{
    private string $userEmail = "itpark.team@gmail.com";
    private string $userName = "IT Park 32";
    private string $password = "newitpark32";

    public function sendMail (Request $request)
    {
        $authorName = $request->name;
        $phoneNumber = $request->phoneNumber;
        $information = $request->information;
        $senderEmail = $request->from;

        $theme = "";

        if ( isset($request->feedback) ) $theme = "Обратная связь";
        if ( isset($request->development) ) $theme = "Разработка";
        if ( isset($request->event) ) $theme = "Организация мероприятия";

        mail($this->userEmail, $theme, "Новое письмо с сайта. Имя отправителя: {$authorName}. Дополнительная информация: {$information}. Номер телефона: {$phoneNumber} !", "From: IT park feedback<itpark.team@gmail.com>");

        return redirect()->back();
    }
}
