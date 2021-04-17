<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

/**
 * Class ActivityController
 * @package App\Http\Controllers
 */
class ActivityController extends Controller
{
    /**
     * Display the logged activities.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $activities = Activity::with(['causer', 'type'])->latest()->paginate(20);

        return view('website-settings.activity')
                ->with(compact('activities'));
    }
}
