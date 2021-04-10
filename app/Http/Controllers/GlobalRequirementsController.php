<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gate;

/**
 * Class GlobalRequirementsController
 * @package App\Http\Controllers
 */
class GlobalRequirementsController extends Controller
{
    /**
     * Update the global requirements for recruitments.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request)
    {
        Gate::authorize('manage-recruitments');

        setting(['global-requirements' => $request->global_requirements])->save();

        return back();
    }
}
