<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Twitch;

class TwitchController extends Controller
{
    protected $client_id = null;

    public function __construct()
    {
        $this->client_id = strval(config('twitch.client_id'));
    }

    public function user($name)
    {
        return Twitch::user($name);
    }

    public function stream($name)
    {
        return Twitch::stream($name);
    }
}
