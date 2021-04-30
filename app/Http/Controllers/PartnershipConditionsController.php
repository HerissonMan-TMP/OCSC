<?php

namespace App\Http\Controllers;

use App\Http\Requests\PartnershipConditions\StorePartnershipConditionsRequest;
use App\Models\ActivityType;
use App\Models\PartnershipConditions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PartnershipConditionsController extends Controller
{
    /**
     * Display the form to create a new version of the privacy policy.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        Gate::authorize('edit-partnership-conditions-and-info');

        $partnershipConditions = PartnershipConditions::latest()->first();

        return view('partnership-conditions.create')
            ->with(compact('partnershipConditions'));
    }

    /**
     * Store a new version of the privacy policy.
     *
     * @param StorePartnershipConditionsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StorePartnershipConditionsRequest $request)
    {
        Gate::authorize('edit-partnership-conditions-and-info');

        $partnershipConditions = PartnershipConditions::create($request->validated());

        activity(ActivityType::UPDATED)
            ->subject('fas fa-handshake', 'Partnership conditions & info')
            ->description("Version N°{$partnershipConditions->id}")
            ->log();

        flash("You have successfully updated the partnership conditions & information!")->success();

        return redirect()->route('partners');
    }
}
