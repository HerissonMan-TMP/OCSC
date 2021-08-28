<?php

namespace App\Http\Controllers;

use App\Http\Requests\PartnerCategories\StorePartnerCategoryRequest;
use App\Http\Requests\PartnerCategories\UpdatePartnerCategoryRequest;
use App\Models\ActivityType;
use App\Models\PartnerCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PartnerCategoryController extends Controller
{
    public function index()
    {
        $partnerCategories = PartnerCategory::all();

        return view('partner-categories.index')
            ->with(compact('partnerCategories'));
    }

    public function edit(PartnerCategory $partnerCategory)
    {
        Gate::authorize('manage-partner-categories');

        return view('partner-categories.edit')
            ->with(compact('partnerCategory'));
    }

    public function store(StorePartnerCategoryRequest $request)
    {
        Gate::authorize('manage-partner-categories');

        $partnerCategory = PartnerCategory::create($request->validated());

        activity(ActivityType::CREATED)
            ->subject("fas fa-handshake", "Supporters Category #{$partnerCategory->id}")
            ->description("Name: {$partnerCategory->name}")
            ->log();

        flash("You have successfully created the supporters category \"{$partnerCategory->name}\"!")->success();

        return redirect()->route('staff.partner-categories.index');
    }

    public function update(PartnerCategory $partnerCategory, UpdatePartnerCategoryRequest $request)
    {
        Gate::authorize('manage-partner-categories');

        $partnerCategory->update($request->validated());

        activity(ActivityType::UPDATED)
            ->subject("fas fa-handshake", "Supporters Category #{$partnerCategory->id}")
            ->description("Name: {$partnerCategory->name}")
            ->log();

        flash("You have successfully updated the supporters category \"{$partnerCategory->name}\"!")->success();

        return redirect()->route('staff.partner-categories.index');
    }

    public function destroy(PartnerCategory $partnerCategory)
    {
        Gate::authorize('manage-partner-categories');

        $partnerCategory->delete();

        activity(ActivityType::DELETED)
            ->subject("fas fa-handshake", "Supporters Category #{$partnerCategory->id}")
            ->description("Name: {$partnerCategory->name}")
            ->log();

        flash("You have successfully deleted the supporters category \"{$partnerCategory->name}\"!")->success();

        return redirect()->route('staff.partner-categories.index');
    }
}
