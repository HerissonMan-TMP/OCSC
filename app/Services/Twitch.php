<?php

namespace App\Services;

use Http;
use Illuminate\Http\Client\RequestException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Twitch
{
    protected $client_id;

    protected $channel_name;

    protected $url;

    public function __construct()
    {
        $this->client_id = config('twitch.client_id');

        $this->channel_name = config('twitch.channel_name');

        $this->url = config('twitch.url');
    }

    public function call(string $method, string $endpoint, array $parameters = [])
    {
        try {
            $response = Http::retry(3, 200)
                ->post('https://id.twitch.tv/oauth2/token?client_id=ffoer4pyc71hmfm3q47ojnvw5gq091&client_secret=v6dmvaak3g2xb3qcfqfve29a2my3c5&grant_type=client_credentials');
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => '1Something went wrong when connecting to the Twitch API.',
            ]);
        }

        $accessToken = $response->json()['access_token'];

        //v6dmvaak3g2xb3qcfqfve29a2my3c5
        try {
            $response = Http::retry(3, 200)
                ->withHeaders([
                    'Accept' => 'application/vnd.twitchtv.v5+json',
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Client-ID' => $this->client_id,
                ])
                ->{$method}(config('twitch.url') . $endpoint, $parameters);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => '2Something went wrong when connecting to the Twitch API.',
            ]);
        }

        $json = $response->json();
        $json['error'] = false;
        $json['message'] = '';

        return $json;
    }

    public function methodIsValid(string $method): bool
    {
        $allowedMethods = [
            'get',
            'post',
            'put',
            'patch',
            'delete',
        ];

        return in_array($method, $allowedMethods);
    }

    public function user(string $name): array
    {
        return $this->call(
            'GET',
            'users',
            [
                'login' => $name
            ]
        )['data']['0'];
    }

    public function stream(string $name): array
    {
        return $this->call(
            'GET',
            'streams/' . $this->user($name)['id'],
        );
    }
}
