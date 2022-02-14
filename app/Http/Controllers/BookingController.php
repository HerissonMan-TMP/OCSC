<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create() {
        //remove at launch
        abort(403);
        return view('bookings.create');
    }
}
