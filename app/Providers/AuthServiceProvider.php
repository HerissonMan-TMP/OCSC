<?php

namespace App\Providers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $abilitiesWithoutBypass = [
            'update-permissions-for-role'
        ];
        Gate::before(function (User $user, $ability) use ($abilitiesWithoutBypass) {
            if (!in_array($ability, $abilitiesWithoutBypass) && $user->hasPermission('has-admin-rights')) {
                return true;
            }
        });

        $ability = 'has-admin-rights';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission($ability)
                ? Response::allow()
                : Response::deny('You do not have Admin Rights.');
        });

        $ability = 'manage-recruitments';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission($ability)
                ? Response::allow()
                : Response::deny('You are not allowed to manage recruitments.');
        });

        $ability = 'see-staff-members-list';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission($ability)
                ? Response::allow()
                : Response::deny('You are not allowed to see the Staff members list.');
        });

        $ability = 'see-temporary-password-of-new-staff-members';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission($ability)
                ? Response::allow()
                : Response::deny('You are not allowed to see the new Staff members\' temporary password.');
        });

        $ability = 'assign-roles';
        Gate::define($ability, function (User $user, User $targetUser) use ($ability) {
            return $user->hasPermission($ability)
                && $user->roles->first()->group_level < $targetUser->roles->first()->group_level
                && $user->isNot($targetUser)
                ? Response::allow()
                : Response::deny('You are not allowed to assign roles.');
        });

        $ability = 'update-permissions';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission($ability)
                ? Response::allow()
                : Response::deny('You are not allowed to update permissions.');
        });

        $ability = 'update-permissions-for-role';
        Gate::define($ability, function (User $user, Role $targetRole) use ($ability) {
           return ($user->hasPermission('update-permissions') || $user->hasPermission('has-admin-rights'))
               && !$targetRole->hasPermission('has-admin-rights')
               && $user->roles->first()->order < $targetRole->order
               ? Response::allow()
               : Response::deny('You are not allowed to update the permissions for this role.');
        });
    }
}
