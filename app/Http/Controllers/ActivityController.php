<?php

namespace App\Http\Controllers;

use App\Filters\SubscriberFilters;
use App\Models\Activity;
use App\Models\ActivityType;
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
     * @param SubscriberFilters $filters
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(SubscriberFilters $filters)
    {
        $activityTypes = ActivityType::all();
        $activities = Activity::filter($filters)->with(['causer', 'type'])->paginate(20);

        return view('website-settings.activity')
                ->with(compact('activityTypes'))
                ->with(compact('activities'));
    }
}
