<?php

namespace App\Http\Controllers;

use App\Models\Convoy;
use App\Services\TruckersMPAPI;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $eventRequest;

    public function __construct(TruckersMPAPI\EventRequest $eventRequest)
    {
        $this->eventRequest = $eventRequest;
    }

    public function homepage()
    {
        $convoys = Convoy::take(3)->where('meetup_date', '>', now())->oldest('meetup_date')->get();

        $events = [];

        $counter = 0;
        foreach ($convoys->pluck('truckersmp_event_id') as $convoy) {
            array_push($events, $this->eventRequest->event($convoy)->get()['response']);
            $events[$counter]['distance'] = $convoys->pluck('distance')->get($counter);
            $counter++;
        }

        return view('homepage')
                ->with('events', $events);
    }
}
