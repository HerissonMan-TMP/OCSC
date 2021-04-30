<?php

namespace App\Http\Controllers;

use App\Filters\ConvoyFilters;
use App\Http\Requests\Convoy\StoreConvoyRequest;
use App\Http\Requests\Convoy\UpdateConvoyRequest;
use App\Models\ActivityType;
use App\Models\Convoy;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;

/**
 * Class ConvoyController
 * @package App\Http\Controllers
 */
class ConvoyController extends Controller
{
    /**
     * Display all the convoys.
     *
     * @param ConvoyFilters $filters
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(ConvoyFilters $filters)
    {
        $convoyModels = Convoy::filter($filters)->get();

        $responses = Http::pool(function (Pool $pool) use ($convoyModels) {
            $responses = [];

            foreach ($convoyModels as $convoyModel) {
                $url = 'https://api.truckersmp.com/v2/events/';
                array_push($responses, $pool->get($url . $convoyModel->id));
            }

            return $responses;
        });

        return view('convoys.index')
                ->with(compact('convoys'));
    }

    /**
     * Display the convoys (Public side).
     *
     * @param ConvoyFilters $filters
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function convoys(ConvoyFilters $filters)
    {
        $convoys = Convoy::filter($filters)->paginate(12);

        return view('convoys.convoys')
                ->with(compact('convoys'));
    }

    /**
     * Display the form to create a new convoy.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        Gate::authorize('manage-convoys');

        return view('convoys.create');
    }

    /**
     * Store a new convoy in the database.
     *
     * @param StoreConvoyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreConvoyRequest $request)
    {
        Gate::authorize('manage-convoys');

        $convoy = Convoy::create($request->validated());

        activity(ActivityType::CREATED)
            ->subject('fas fa-truck', "Convoy #{$convoy->id}")
            ->description("Name: {$convoy->title}")
            ->log();

        flash("You have successfully posted a new convoy!")->success();

        return redirect()->route('staff.convoys.index');
    }

    /**
     * Display the form to edit the given convoy.
     *
     * @param Convoy $convoy
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Convoy $convoy)
    {
        Gate::authorize('manage-convoys');

        return view('convoys.edit')
                ->with(compact('convoy'));
    }

    /**
     * Update the given convoy.
     *
     * @param Convoy $convoy
     * @param UpdateConvoyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Convoy $convoy, UpdateConvoyRequest $request)
    {
        Gate::authorize('manage-convoys');

        $convoy->update($request->validated());

        activity(ActivityType::UPDATED)
            ->subject('fas fa-truck', "Convoy #{$convoy->id}")
            ->description("Name: {$convoy->title}")
            ->log();

        flash("You have successfully updated the convoy '{$convoy->name}'!")->success();

        return redirect()->route('staff.convoys.index');
    }

    /**
     * Delete the given convoy.
     *
     * @param Convoy $convoy
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Convoy $convoy)
    {
        Gate::authorize('manage-convoys');

        $convoy->delete();

        activity(ActivityType::DELETED)
            ->subject('fas fa-truck', "Convoy #{$convoy->id}")
            ->description("Name: {$convoy->title}")
            ->log();

        flash("You have successfully deleted the convoy '{$convoy->name}'!")->success();

        return redirect()->route('staff.convoys.index');
    }
}
