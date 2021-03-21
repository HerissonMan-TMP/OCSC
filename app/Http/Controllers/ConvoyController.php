<?php

namespace App\Http\Controllers;

use App\Http\Requests\Convoy\StoreConvoyRequest;
use App\Http\Requests\Convoy\UpdateConvoyRequest;
use App\Models\Convoy;
use App\Models\WebsiteSetting;
use App\Services\TruckersMPAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;

class ConvoyController extends Controller
{
    protected $convoy;

    protected $eventRequest;

    public function __construct(Convoy $convoy, TruckersMPAPI\EventRequest $eventRequest)
    {
        $this->convoy = $convoy;
        $this->eventRequest = $eventRequest;
    }

    public function index()
    {
        Gate::authorize('manage-convoys');

        $convoys = Convoy::latest('meetup_date')->get();

        return view('convoys.index')
                ->with('convoys', $convoys)
                ->with('convoyRules', WebsiteSetting::where('key', 'convoy-rules')->pluck('value')->first());
    }

    public function showUpcoming()
    {
        $convoys = Convoy::where('meetup_date', '>', now())->oldest('meetup_date')->get();

        return view('convoys.upcoming-convoys')
            ->with('convoys', $convoys);
    }

    public function showRules()
    {
        return view('convoys.rules')
                ->with('convoyRules', WebsiteSetting::where('key', 'convoy-rules')->pluck('value')->first());
    }

    public function show(Convoy $convoy)
    {

    }

    public function create()
    {
        Gate::authorize('manage-convoys');

        return view('convoys.create');
    }

    public function store(StoreConvoyRequest $request)
    {
        Gate::authorize('manage-convoys');

        $this->convoy->fill($request->validated());
        $this->convoy->save();

        return redirect()->route('staff.convoys.index');
    }

    public function edit(Convoy $convoy)
    {
        Gate::authorize('manage-convoys');

        return view('convoys.edit')
                ->with('convoy', $convoy);
    }

    public function update(Convoy $convoy, UpdateConvoyRequest $request)
    {
        Gate::authorize('manage-convoys');

        $convoy->update($request->validated());

        return redirect()->route('staff.convoys.index');
    }

    public function destroy(Convoy $convoy)
    {
        Gate::authorize('manage-convoys');

        $convoy->delete();

        return redirect()->route('staff.convoys.index');
    }
}
