<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConvoyRules\StoreConvoyRulesRequest;
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
     */
    public function create()
    {
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
        Gate::authorize('manage-convoys');

        ConvoyRules::create($request->validated());

        flash("You have successfully updated the convoy rules!")->success();

        return back();
    }
}
