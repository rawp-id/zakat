<?php

namespace App\Utils;

class Api
{
    static function getUrl($url)
    {
        $scheme = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];

        return $scheme . '://' . $host . $url;
    }
}
