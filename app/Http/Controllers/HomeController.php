<?php

namespace App\Http\Controllers;

use App\Models\Convoy;
use App\Models\Partner;

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
        $convoys = Convoy::take(3)->upcoming()->oldest('meetup_date')->get();
        $partners = Partner::inRandomOrder()->get();

        return view('homepage')
            ->with(compact('convoys'))
            ->with(compact('partners'));
    }
}
