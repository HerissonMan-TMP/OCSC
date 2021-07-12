<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaintenanceMode\EnableMaintenanceModeRequest;
use App\Models\ActivityType;
use App\Services\DiscordEmbed;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Gate;

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
        Gate::authorize('toggle-maintenance-mode');

        Artisan::call('down', [
            '--render' => 'errors::503',
            '--secret' => $request->secret
        ]);

        (new DiscordEmbed())
            ->webhook(config('discord_webhooks.general'))
            ->username('OCSC Event - Worker')
            ->author('OCSC Event', config('app.url'), asset('img/ocsc_logo.png'))
            ->color(1096065)
            ->thumbnail(config('app.url') . '/img/ocsc_logo.png')
            ->title('🛠 - Maintenance Mode')
            ->description('The website\'s maintenance mode has just been **enabled**.
                You will be notified when it will become available again.
                Thank you for your patience!'
            )
            ->image('https://media.discordapp.net/attachments/824978783051448340/849887295611994152/ets2_20210515_230820_00.png?width=1246&height=701')
            ->footer('https://ocsc.fr', asset('img/ocsc_logo.png'))
            ->send();

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
        Gate::authorize('toggle-maintenance-mode');

        Artisan::call('up');

        (new DiscordEmbed())
            ->webhook(config('discord_webhooks.general'))
            ->username('OCSC Event - Worker')
            ->author('OCSC Event', config('app.url'), asset('img/ocsc_logo.png'))
            ->color(15680580)
            ->thumbnail(config('app.url') . '/img/ocsc_logo.png')
            ->title('🛠 - Maintenance Mode')
            ->description('The website\'s maintenance mode has just been **disabled**. You can browse our website again!')
            ->footer('https://ocsc.fr', asset('img/ocsc_logo.png'))
            ->send();

        activity(ActivityType::DISABLED)
            ->subject('fas fa-wrench', 'Maintenance Mode')
            ->log();

        flash("You have successfully disabled the maintenance mode!")->success();

        return redirect()->route('homepage');
    }
}
