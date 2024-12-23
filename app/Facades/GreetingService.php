<?php

namespace App\Facades;

class GreetingService
{
    public function sayHello($name)
    {
        return "Hello, $name!";
    }
}
