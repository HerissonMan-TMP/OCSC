<?php

namespace App\Http\Controllers;

use App\Http\Requests\GlobalRequirements\StoreGlobalRequirementsRequest;
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
     */
    public function create()
    {
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
        Gate::authorize('manage-recruitments');

        GlobalRequirements::create($request->validated());

        return back();
    }
}
