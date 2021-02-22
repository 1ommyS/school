<?php


namespace App\utils;


class FormatUtils
{
    public static function UrlDecode (string $str)
    {
        return str_replace("%23", "#", str_replace("%20", " ", $str));
    }

    public static function UrlEncode (string $str)
    {
        return str_replace("#", "%23", str_replace(" ", "%20", $str));
    }
}