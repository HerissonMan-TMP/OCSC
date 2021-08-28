<?php

namespace App\Console;

use App\Models\Activity;
use App\Models\Convoy;
use App\Models\Error;
use App\Services\DiscordEmbed;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            Activity::where('created_at', '<', now()->subWeek())->delete();
        })->everySixHours();

        $schedule->call(function () {
            Error::where('created_at', '<', now()->subWeek())->delete();
        })->everySixHours();

        $schedule->call(function () {
            $ids = Convoy::all()->pluck('truckersmp_event_id');

            $responses = Http::pool(function (Pool $pool) use ($ids) {
                $responses = [];

                foreach ($ids as $id) {
                    array_push($responses, $pool->get('https://api.truckersmp.com/v2/events/' . $id));
                }

                return $responses;
            });

            $convoys = array_map(function ($response) {
                return $response->json();
            }, $responses);

            $upcomingConvoysInTheWeek = [];
            foreach ($convoys as $convoy) {
                $startAt = Carbon::createFromFormat('Y-m-d H:i:s', $convoy['response']['start_at']);

                if ($startAt->greaterThan(Carbon::now()->addHours(5)) && $startAt->lessThan(Carbon::now()->addWeek()->addHours(5))) {
                    array_push($upcomingConvoysInTheWeek, $convoy);
                }
            }

            $upcomingConvoysInTheWeek = collect($upcomingConvoysInTheWeek)
                ->sortBy('response.start_at');

            foreach ($upcomingConvoysInTheWeek as $convoy) {
                (new DiscordEmbed())->event($convoy)->send();
            }
        })->weeklyOn(7, '16:00');

        $schedule->call(function () {
            $ids = Convoy::all()->pluck('truckersmp_event_id');

            $responses = Http::pool(function (Pool $pool) use ($ids) {
                $responses = [];

                foreach ($ids as $id) {
                    array_push($responses, $pool->get('https://api.truckersmp.com/v2/events/' . $id));
                }

                return $responses;
            });

            $convoys = array_map(function ($response) {
                return $response->json();
            }, $responses);

            $upcomingConvoys = [];
            foreach ($convoys as $convoy) {
                $startAt = Carbon::createFromFormat('Y-m-d H:i:s', $convoy['response']['start_at']);

                if ($startAt->greaterThan(Carbon::now()) && $startAt->lessThan(Carbon::now()->addHours(14))) {
                    array_push($upcomingConvoy, $convoy);
                }
            }

            $upcomingConvoys = collect($upcomingConvoys)
                ->sortBy('response.start_at');

            foreach ($upcomingConvoys as $convoy) {
                (new DiscordEmbed())->event($convoy)->content('A convoy is starting soon!')->send();
            }
        })->dailyAt('7:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
