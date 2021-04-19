<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Twitch;

/**
 * Class TwitchController
 * @package App\Http\Controllers\Api
 */
class TwitchController extends Controller
{
    /**
     * The Twitch Client ID.
     *
     * @var string|null
     */
    protected $client_id = null;

    /**
     * TwitchController constructor.
     */
    public function __construct()
    {
        $this->client_id = strval(config('twitch.client_id'));
    }

    /**
     * Return the Twitch user's profile information.
     *
     * @param $name
     * @return array
     */
    public function user($name)
    {
        return Twitch::user($name);
    }

    /**
     * Return the current stream of the Twitch user.
     *
     * @param $name
     * @return array
     */
    public function stream($name)
    {
        return Twitch::stream($name);
    }
}
