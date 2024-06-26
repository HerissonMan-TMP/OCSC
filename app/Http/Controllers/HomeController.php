<?php

namespace App\Http\Controllers;

use App\Models\Convoy;
use App\Models\Partner;
use App\Services\TruckersMP;
use Carbon\Carbon;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Display the website's homepage.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function homepage()
    {
        $convoyIds = Convoy::all()->pluck('truckersmp_event_id')->toArray();

        $convoys = TruckersMP::events($convoyIds, true)->take(3);

        $partners = Partner::inRandomOrder()->get();

        return view('homepage')
            ->with(compact('convoys', 'partners'));
    }
}
