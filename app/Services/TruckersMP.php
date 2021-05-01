<?php

namespace App\Services;

use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class TruckersMP
{
    protected static string $url = 'https://api.truckersmp.com/v2/';

    public static function events(array $ids): array
    {
        return Cache::remember('convoys', 5 * 60, function () use ($ids) {
            $responses = Http::pool(function (Pool $pool) use ($ids) {
                $responses = [];

                foreach ($ids as $id) {
                    array_push($responses, $pool->get(self::$url . 'events/' . $id));
                }

                return $responses;
            });

            return array_map(function ($response) {
                return $response->json();
            }, $responses);
        });
    }
}
