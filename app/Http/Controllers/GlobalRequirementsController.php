<?php

namespace App\Http\Controllers;

use App\Http\Requests\GlobalRequirements\StoreGlobalRequirementsRequest;
use App\Models\ActivityType;
use App\Models\GlobalRequirements;
use Illuminate\Http\Request;
use Gate;

/**
 * Class GlobalRequirementsController
 * @package App\Http\Controllers
 */
class GlobalRequirementsController extends Controller
{
    /**
     * Display the latest version of the global requirements.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show()
    {
        $globalRequirements = GlobalRequirements::latest()->first();

        return view('global-requirements.show')
            ->with(compact('globalRequirements'));
    }

    /**
     * Display the form to create a new version of the global requirements.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        Gate::authorize('edit-global-requirements');

        $globalRequirements = GlobalRequirements::latest()->first();

        return view('global-requirements.create')
            ->with(compact('globalRequirements'));
    }

    /**
     * Store a new version of the global requirements.
     *
     * @param StoreGlobalRequirementsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreGlobalRequirementsRequest $request)
    {
        Gate::authorize('edit-global-requirements');

        $globalRequirements = GlobalRequirements::create($request->validated());

        activity(ActivityType::UPDATED)
            ->subject('fas fa-tasks', 'Global Requirements')
            ->description("Version N°{$globalRequirements->id}")
            ->log();

        flash("You have successfully updated the global requirements!")->success();

        return back();
    }
}
