<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrivacyPolicy\StorePrivacyPolicyRequest;
use App\Models\ActivityType;
use App\Models\PrivacyPolicy;
use Illuminate\Support\Facades\Gate;

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
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        Gate::authorize('edit-privacy-policy');

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
        Gate::authorize('edit-privacy-policy');

        $privacyPolicy = PrivacyPolicy::create($request->validated());

        activity(ActivityType::UPDATED)
            ->subject('fas fa-user-secret', 'Privacy Policy')
            ->description("Version N°{$privacyPolicy->id}")
            ->log();

        flash("You have successfully updated the privacy policy!")->success();

        return redirect()->route('privacy-policy.show');
    }
}
