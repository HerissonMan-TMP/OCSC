<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Twitch extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'twitch';
    }
}
