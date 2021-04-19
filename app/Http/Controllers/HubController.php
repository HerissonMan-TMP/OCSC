<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Convoy;
use App\Models\User;

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

        return view('hub')
                ->with(compact('counters'));
    }
}
