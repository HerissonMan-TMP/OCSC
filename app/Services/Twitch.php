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
        if (!$this->methodIsValid(strtolower($method))) {
            return response()->json([
                'error' => true,
                'message' => 'The request method is not valid.',
            ]);
        }

        try {
            $response = Http::retry(3, 200)
                ->withHeaders([
                    'Accept' => 'application/vnd.twitchtv.v5+json',
                    'Client-ID' => $this->client_id,
                ])
                ->{$method}(config('twitch.url') . $endpoint, $parameters);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Something went wrong when connecting to the Twitch API.',
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
        )['users']['0'];
    }

    public function stream(string $name): array
    {
        return $this->call(
            'GET',
            'streams/' . $this->user($name)['_id'],
        );
    }
}
