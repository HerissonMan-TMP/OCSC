<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ConvoyRulesController extends Controller
{
    /**
     * Update the convoy rules.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        Gate::authorize('manage-convoys');

        setting(['convoy-rules' => $request->convoy_rules])->save();

        return back();
    }
}
