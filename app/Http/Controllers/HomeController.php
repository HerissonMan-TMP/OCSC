<?php

namespace App\Http\Controllers;

use App\Models\Convoy;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function homepage()
    {
        $convoys = Convoy::take(3)->where('meetup_date', '>', now())->oldest('meetup_date')->get();

        return view('homepage')
                ->with('convoys', $convoys);
    }
}
