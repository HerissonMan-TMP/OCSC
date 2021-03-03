<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffHubController extends Controller
{
    /**
     * Display the Staff Hub.
     */
    public function showHub()
    {
        return view('staff.hub');
    }
}
