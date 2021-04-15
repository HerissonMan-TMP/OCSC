<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaintenanceMode\EnableMaintenanceModeRequest;
use Artisan;
use Gate;

/**
 * Class MaintenanceModeController
 * @package App\Http\Controllers
 */
class MaintenanceModeController extends Controller
{
    /**
     * Enable the maintenance mode.
     *
     * @param EnableMaintenanceModeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function enable(EnableMaintenanceModeRequest $request)
    {
        Gate::authorize('has-admin-rights');

        Artisan::call('down', [
            '--render' => 'errors::503',
            '--secret' => $request->secret
        ]);

        flash("You have successfully enabled the maintenance mode!")->success();

        return redirect()->to("/{$request->secret}");
    }

    /**
     * Disable the maintenance mode.
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function disable()
    {
        Gate::authorize('has-admin-rights');

        Artisan::call('up');

        flash("You have successfully disabled the maintenance mode!")->success();

        return redirect()->route('homepage');
    }
}
