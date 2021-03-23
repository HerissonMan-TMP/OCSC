<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class GlobalRequirementsController extends Controller
{
    /**
     * Update the global requirements for recruitments.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        Gate::authorize('manage-recruitments');

        setting(['global-requirements' => $request->global_requirements])->save();

        return back();
    }
}
