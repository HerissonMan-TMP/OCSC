<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gate;

/**
 * Class ConvoyRulesController
 * @package App\Http\Controllers
 */
class ConvoyRulesController extends Controller
{
    /**
     * Update the convoy rules.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request)
    {
        Gate::authorize('manage-convoys');

        setting(['convoy-rules' => $request->convoy_rules])->save();

        return back();
    }
}
