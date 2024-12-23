<?php

namespace App\Services;


class UptimeRobotAPI
{
    public function __construct()
    {


    }

    public  function getUrl() {
        $url =  'https://api.uptimerobot.com/v2/';
        return $url;
    }
}
