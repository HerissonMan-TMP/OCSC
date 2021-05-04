<?php

namespace App\Http\Controllers;

use App\Http\Requests\LegalNotice\StoreLegalNoticeRequest;
use App\Models\ActivityType;
use App\Models\LegalNotice;
use Illuminate\Support\Facades\Gate;

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

        return view('legal-notice.show')
            ->with(compact('legalNotice'));
    }

    /**
     * Display the form to create a new version of the legal notice.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        Gate::authorize('edit-legal-notice');

        $legalNotice = LegalNotice::latest()->first();

        return view('legal-notice.create')
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
        Gate::authorize('edit-legal-notice');

        $legalNotice = LegalNotice::create($request->validated());

        activity(ActivityType::UPDATED)
            ->subject('fas fa-balance-scale', 'Legal Notice')
            ->description("Version N°{$legalNotice->id}")
            ->log();

        flash("You have successfully updated the legal notice!")->success();

        return redirect()->route('legal-notice.show');
    }
}
