<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaintenanceMode\EnableMaintenanceModeRequest;
use App\Models\ActivityType;
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

        activity(ActivityType::ENABLED)
            ->subject('fas fa-wrench', 'Maintenance Mode')
            ->log();

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

        activity(ActivityType::DISABLED)
            ->subject('fas fa-wrench', 'Maintenance Mode')
            ->log();

        flash("You have successfully disabled the maintenance mode!")->success();

        return redirect()->route('homepage');
    }
}
