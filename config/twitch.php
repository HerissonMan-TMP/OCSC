<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Twitch Client ID
    |--------------------------------------------------------------------------
    |
    | Used to send requests to the Twitch API.
    |
    */

    'client_id' => env('TWITCH_CLIENT_ID', 0),

    'client_secret' => env('TWITCH_CLIENT_SECRET', 0),

    /*
    |--------------------------------------------------------------------------
    | Twitch Channel Name
    |--------------------------------------------------------------------------
    |
    | The name of the website's Twitch channel.
    |
    */

    'channel_name' => env('TWITCH_CHANNEL_NAME', 'ocsc_official'),

    /*
    |--------------------------------------------------------------------------
    | Twitch API URL
    |--------------------------------------------------------------------------
    |
    | The URL of the Twitch API.
    |
    */

    'url' => 'https://api.twitch.tv/helix/',

];
