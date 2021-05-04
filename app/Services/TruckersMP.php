<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class TruckersMP
{
    protected static string $url = 'https://api.truckersmp.com/v2/';

    public static function events(array $ids, bool $upcomingOnly = false): Collection
    {
        $convoys = Cache::remember('convoys', 10 * 60, function () use ($ids) {
            $responses = Http::pool(function (Pool $pool) use ($ids) {
                $responses = [];

                foreach ($ids as $id) {
                    array_push($responses, $pool->get(self::$url . 'events/' . $id));
                }

                return $responses;
            });

            $convoys = array_map(function ($response) {
                return $response->json();
            }, $responses);

            return collect($convoys)
                ->sortBy('response.start_at')
                ->filter(function ($value, $key) {
                    if (!$value['error']) {
                        return true;
                    }
                });
        });

        $convoys = $convoys->when($upcomingOnly, function ($collection) {
            return $collection->filter(function ($value, $key) {
                return Carbon::parse($value['response']['start_at'])->isFuture();
            });
        });

        return $convoys;
    }
}
