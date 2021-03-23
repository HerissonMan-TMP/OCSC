<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaintenanceMode\EnableMaintenanceModeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Gate;

class MaintenanceModeController extends Controller
{
    public function enable(EnableMaintenanceModeRequest $request)
    {
        Gate::authorize('has-admin-rights');

        Artisan::call('down', [
            '--render' => 'errors::503',
            '--secret' => $request->secret
        ]);

        return redirect()->to("/{$request->secret}");
    }

    public function disable()
    {
        Gate::authorize('has-admin-rights');

        Artisan::call('up');

        return redirect()->route('homepage');
    }
}
