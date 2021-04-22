<?php

namespace App\Http\Controllers;

use App\Http\Requests\Guides\StoreGuideRequest;
use App\Http\Requests\Guides\UpdateGuideRequest;
use App\Models\ActivityType;
use App\Models\Guide;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

/**
 * Class GuideController
 * @package App\Http\Controllers
 */
class GuideController extends Controller
{
    public function index()
    {
        $guides = Guide::accessible()->get();

        return view('guides.index')
            ->with(compact('guides'));
    }

    public function show(Guide $guide)
    {
        Gate::authorize('read-guide', $guide);

        return view('guides.show')
            ->with(compact('guide'));
    }

    public function create()
    {
        Gate::authorize('manage-guides');

        $roles = Role::orderBy('order')->get();

        return view('guides.create')
            ->with(compact('roles'));
    }

    public function store(StoreGuideRequest $request)
    {
        Gate::authorize('manage-guides');

        $guide = Guide::create($request->validated());
        $guide->roles()->attach($request->roles);

        activity(ActivityType::CREATED)
            ->subject('fas fa-book', "Guide #{$guide->id}")
            ->description("Name: {$guide->title}")
            ->log();

        flash("You have successfully created a new guide!")->success();

        return redirect()->route('staff.guides.index');
    }

    public function edit(Guide $guide)
    {
        Gate::authorize('manage-guides');

        $guide = $guide->load('roles');
        $roles = Role::orderBy('order')->get();

        return view('guides.edit')
            ->with(compact('guide'))
            ->with(compact('roles'));
    }

    public function update(Guide $guide, UpdateGuideRequest $request)
    {
        Gate::authorize('manage-guides');

        $guide->update($request->validated());
        $guide->roles()->sync($request->roles);

        activity(ActivityType::UPDATED)
            ->subject('fas fa-book', "Guide #{$guide->id}")
            ->description("Name: {$guide->title}")
            ->log();

        flash("You have successfully updated the guide \"{$guide->title}\"!")->success();

        return redirect()->route('staff.guides.index');
    }

    public function destroy(Guide $guide)
    {
        Gate::authorize('manage-guides');

        $guide->delete();

        activity(ActivityType::DELETED)
            ->subject('fas fa-book', "Guide #{$guide->id}")
            ->description("Name: {$guide->title}")
            ->log();

        flash("You have successfully deleted the guide \"{$guide->title}\"!")->success();

        return redirect()->route('staff.guides.index');
    }
}
