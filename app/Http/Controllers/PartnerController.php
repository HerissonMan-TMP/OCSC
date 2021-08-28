<?php

namespace App\Http\Controllers;

use App\Http\Requests\Partners\StorePartnerRequest;
use App\Http\Requests\Partners\UpdatePartnerRequest;
use App\Models\ActivityType;
use App\Models\Partner;
use App\Models\PartnerCategory;
use App\Models\PartnershipConditions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PartnerController extends Controller
{
    public function partners()
    {
        $partnerCategories = PartnerCategory::with('partners')->get();
        $partnershipConditions = PartnershipConditions::latest()->first();

        return view('partners.partners')
            ->with(compact('partnerCategories'))
            ->with(compact('partnershipConditions'));
    }

    public function index()
    {
        $partnerCategories = PartnerCategory::with('partners')->get();

        return view('partners.index')
            ->with(compact('partnerCategories'));
    }

    public function create()
    {
        Gate::authorize('manage-partners');

        $partnerCategories = PartnerCategory::all();

        return view('partners.create')
            ->with(compact('partnerCategories'));
    }

    public function store(StorePartnerRequest $request)
    {
        Gate::authorize('manage-partners');

        $partner = PartnerCategory::find($request->category_id)->partners()->create($request->validated());

        activity(ActivityType::CREATED)
            ->subject("fas fa-handshake", "Supporter #{$partner->id}")
            ->description("Name: {$partner->name}")
            ->log();

        flash("You have successfully added a new Supporter!")->success();

        return redirect()->route('staff.partners.index');
    }

    public function edit(Partner $partner)
    {
        Gate::authorize('manage-partners');

        $partnerCategories = PartnerCategory::all();

        return view('partners.edit')
            ->with(compact('partner'))
            ->with(compact('partnerCategories'));
    }

    public function update(Partner $partner, UpdatePartnerRequest $request)
    {
        Gate::authorize('manage-partners');

        $partner->update($request->validated());

        activity(ActivityType::UPDATED)
            ->subject("fas fa-handshake", "Supporter #{$partner->id}")
            ->description("Name: {$partner->name}")
            ->log();

        flash("You have successfully edited the Supporter \"{$partner->name}\"!")->success();

        return redirect()->route('staff.partners.index');
    }

    public function destroy(Partner $partner)
    {
        Gate::authorize('manage-partners');

        $partner->delete();

        activity(ActivityType::DELETED)
            ->subject("fas fa-handshake", "Supporter #{$partner->id}")
            ->description("Name: {$partner->name}")
            ->log();

        flash("You have successfully deleted the Supporter \"{$partner->name}\"!")->success();

        return redirect()->route('staff.partners.index');
    }
}
