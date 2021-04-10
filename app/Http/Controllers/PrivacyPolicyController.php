<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gate;

/**
 * Class PrivacyPolicyController
 * @package App\Http\Controllers
 */
class PrivacyPolicyController extends Controller
{
    /**
     * Update the legal notice.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request)
    {
        Gate::authorize('has-admin-rights');

        setting(['privacy-policy' => $request->privacy_policy])->save();

        return back();
    }
}
