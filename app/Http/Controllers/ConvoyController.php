<?php

namespace App\Http\Controllers;

use App\Http\Requests\Convoy\StoreConvoyRequest;
use App\Http\Requests\Convoy\UpdateConvoyRequest;
use App\Models\ActivityType;
use App\Models\Convoy;
use App\Services\ArrayCollectionPaginator;
use App\Services\TruckersMP;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Cache;
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $convoyIds = Convoy::all()->pluck('truckersmp_event_id')->toArray();

        $convoys = TruckersMP::events($convoyIds);

        $convoys = ArrayCollectionPaginator::paginate(
            collect($convoys)->sortBy('response.start_at')
        )
        ->withPath(request()->getPathInfo());

        return view('convoys.index')
                ->with(compact('convoys'));
    }

    /**
     * Display the convoys (Public side).
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function convoys()
    {
        $convoyIds = Convoy::all()->pluck('truckersmp_event_id')->toArray();

        $convoys = TruckersMP::events($convoyIds);

        $convoys = ArrayCollectionPaginator::paginate(
            collect($convoys)->sortBy('response.start_at')
        )
            ->withPath(request()->getPathInfo());

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

        Cache::forget('convoys');

        activity(ActivityType::CREATED)
            ->subject('fas fa-truck', "Convoy #{$convoy->truckersmp_event_id}")
            ->log();

        flash("You have successfully posted a new convoy!")->success();

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

        Cache::forget('convoys');

        activity(ActivityType::DELETED)
            ->subject('fas fa-truck', "Convoy (TMP ID {$convoy->truckersmp_event_id})")
            ->log();

        flash("You have successfully deleted the convoy!")->success();

        return redirect()->route('staff.convoys.index');
    }

    public function edit(Convoy $convoy)
    {
        dd($convoy);
    }
}
