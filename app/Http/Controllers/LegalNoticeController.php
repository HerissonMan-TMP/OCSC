<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class LegalNoticeController extends Controller
{
    /**
     * Update the legal notice.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        Gate::authorize('has-admin-rights');

        setting(['legal-notice' => $request->legal_notice])->save();

        return back();
    }
}
