<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gate;

class LegalNoticeController extends Controller
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

        setting(['legal-notice' => $request->legal_notice])->save();

        return back();
    }
}
