<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConvoyRules\StoreConvoyRulesRequest;
use App\Models\ActivityType;
use App\Models\ConvoyRules;
use Illuminate\Http\Request;
use Gate;

/**
 * Class ConvoyRulesController
 * @package App\Http\Controllers
 */
class ConvoyRulesController extends Controller
{
    /**
     * Display the latest version of the convoy rules.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show()
    {
        $convoyRules = ConvoyRules::latest()->first();

        return view('convoy-rules.show')
            ->with(compact('convoyRules'));
    }

    /**
     * Display the form to create a new version of the convoy rules.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        Gate::authorize('edit-convoy-rules');

        return view('convoy-rules.create');
    }

    /**
     * Store a new version of the convoy rules.
     *
     * @param StoreConvoyRulesRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreConvoyRulesRequest $request)
    {
        Gate::authorize('edit-convoy-rules');

        $convoyRules = ConvoyRules::create($request->validated());

        activity(ActivityType::UPDATED)
            ->subject('fas fa-list-alt', 'Convoy Rules')
            ->description("Version N°{$convoyRules->id}")
            ->log();

        flash("You have successfully updated the convoy rules!")->success();

        return back();
    }
}
