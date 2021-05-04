<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Convoy;
use App\Models\User;
use App\Services\TruckersMP;
use Carbon\Carbon;

/**
 * Class HubController
 * @package App\Http\Controllers
 */
class HubController extends Controller
{
    /**
     * Display the Staff Hub.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show()
    {
        $counters['convoys'] = Convoy::count();
        $counters['articles'] = Article::count();
        $counters['users'] = User::count();

        $latestArticle = Article::latest()->first();

        $convoyIds = Convoy::all()->pluck('truckersmp_event_id')->toArray();

        $convoys = TruckersMP::events($convoyIds, true)->take(2);

        return view('hub')
                ->with(compact('counters', 'latestArticle', 'convoys'));
    }
}
