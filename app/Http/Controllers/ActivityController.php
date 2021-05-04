<?php

namespace App\Http\Controllers;

use App\Filters\ActivityFilters;
use App\Models\Activity;
use App\Models\ActivityType;
use Illuminate\Support\Facades\Gate;

/**
 * Class ActivityController
 * @package App\Http\Controllers
 */
class ActivityController extends Controller
{
    /**
     * Display the logged activities.
     *
     * @param ActivityFilters $filters
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(ActivityFilters $filters)
    {
        Gate::authorize('see-activity');

        $activityTypes = ActivityType::all();
        $activities = Activity::filter($filters)->with(['causer', 'type'])->paginate(20);

        return view('website-settings.activity')
            ->with(compact('activityTypes', 'activities'));
    }
}
