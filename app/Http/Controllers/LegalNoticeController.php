<?php

namespace App\Http\Controllers;

use App\Http\Requests\LegalNotice\StoreLegalNoticeRequest;
use App\Models\LegalNotice;
use Gate;

/**
 * Class LegalNoticeController
 * @package App\Http\Controllers
 */
class LegalNoticeController extends Controller
{
    /**
     * Display the latest version of the Privacy policy.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show()
    {
        $legalNotice = LegalNotice::latest()->first();

        return view('legal-notice')
            ->with(compact('legalNotice'));
    }

    /**
     * Store a new version of the privacy policy.
     *
     * @param StoreLegalNoticeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreLegalNoticeRequest $request)
    {
        Gate::authorize('has-admin-rights');

        LegalNotice::create([
            'content' => $request->legal_notice_content
        ]);

        return back();
    }
}
