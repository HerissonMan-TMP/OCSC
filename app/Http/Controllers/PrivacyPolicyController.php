<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrivacyPolicy\StorePrivacyPolicyRequest;
use App\Models\PrivacyPolicy;
use Gate;

/**
 * Class PrivacyPolicyController
 * @package App\Http\Controllers
 */
class PrivacyPolicyController extends Controller
{
    /**
     * Display the latest version of the Privacy policy.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show()
    {
        $privacyPolicy = PrivacyPolicy::latest()->first();

        return view('privacy-policy.show')
                ->with(compact('privacyPolicy'));
    }

    /**
     * Display the form to create a new version of the privacy policy.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $privacyPolicy = PrivacyPolicy::latest()->first();

        return view('privacy-policy.create')
            ->with(compact('privacyPolicy'));
    }

    /**
     * Store a new version of the privacy policy.
     *
     * @param StorePrivacyPolicyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StorePrivacyPolicyRequest $request)
    {
        Gate::authorize('has-admin-rights');

        PrivacyPolicy::create($request->validated());

        return back();
    }
}
