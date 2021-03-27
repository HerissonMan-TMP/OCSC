<?php

namespace App\Providers;

use App\Models\Convoy;
use App\Models\Permission;
use App\Models\Recruitment;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
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
            'assign-roles-to-user',
            'assign-role-to-user',
            'update-permissions-for-role',
            'update-permission-for-role',
            'delete-user'
        ];
        Gate::before(function (User $user, $ability) use ($abilitiesWithoutBypass) {
            if (!in_array($ability, $abilitiesWithoutBypass)
                && $user->hasPermission('has-admin-rights')) {
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
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission($ability)
                ? Response::allow()
                : Response::deny('You are not allowed to assign roles.');
        });

        $ability = 'assign-role';
        Gate::define($ability, function (User $user, Role $role) use ($ability) {
            return $user->hasPermission('assign-roles')
                && $user->roles->first()->group_level < $role->group_level
                ? Response::allow()
                : Response::deny('You are not allowed to assign this role.');
        });

        $ability = 'assign-roles-to-user';
        Gate::define($ability, function (User $user, User $targetUser) use ($ability) {
            return ($user->hasPermission('assign-roles')
                || $user->hasPermission('has-admin-rights'))
                && ($user->roles->first()->group_level < $targetUser->roles->first()->group_level
                || $user->hasPermission('has-admin-rights'))
                && !$targetUser->hasPermission('has-admin-rights')
                ? Response::allow()
                : Response::deny('You are not allowed to assign roles for this user.');
        });

        $ability = 'assign-role-to-user';
        Gate::define($ability, function (User $user, User $targetUser, Role $role) use ($ability) {
            $result = false;
            if ($user->can('assign-roles-to-user', $targetUser)) {
                if ($user->hasPermission('has-admin-rights') && !$targetUser->hasPermission('has-admin-rights')) {
                    $result = true;
                } elseif ($user->roles->first()->group_level < $role->group_level && !$role->hasPermission('has-admin-rights')) {
                    $result = true;
                }
            }
            return $result
                ? Response::allow()
                : Response::deny('You are not allowed to assign this role to this user.');
        });

        $ability = 'update-permissions';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission($ability)
                ? Response::allow()
                : Response::deny('You are not allowed to update permissions.');
        });

        $ability = 'update-permissions-for-role';
        Gate::define($ability, function (User $user, Role $targetRole) use ($ability) {
           return ($user->hasPermission('update-permissions')
               || $user->hasPermission('has-admin-rights'))
               && !$targetRole->hasPermission('has-admin-rights')
               && ($user->roles->first()->group_level < $targetRole->group_level || $user->hasPermission('has-admin-rights'))
               ? Response::allow()
               : Response::deny('You are not allowed to update the permissions for this role.');
        });

        $ability = 'update-permission-for-role';
        Gate::define($ability, function (User $user, Role $targetRole, Permission $targetPermission) use ($ability) {
            $result = false;
            if ($user->can('update-permissions-for-role', $targetRole)) {
                if ($targetPermission->slug === 'has-admin-rights') {
                    if ($user->hasPermission('has-admin-rights') && !$targetRole->hasPermission('has-admin-rights')) {
                        $result = true;
                    }
                } else {
                    $result = true;
                }
            }
            return $result
                ? Response::allow()
                : Response::deny('You are not allowed to update this permission.');
        });

        $ability = 'create-new-users';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission($ability)
                ? Response::allow()
                : Response::deny('You are not allowed to add a new Staff member.');
        });

        $ability = 'read-contact-messages';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission($ability)
                ? Response::allow()
                : Response::deny('You are not allowed to read contact messages.');
        });

        $ability = 'change-contact-messages-status';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission($ability)
                ? Response::allow()
                : Response::deny('You are not allowed to change contact messages status.');
        });

        $ability = 'delete-contact-messages';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission($ability)
                ? Response::allow()
                : Response::deny('You are not allowed to delete contact messages.');
        });

        $ability = 'see-recruitment-form';
        Gate::define($ability, function (User $user, Recruitment $recruitment) use ($ability) {
            return $recruitment->is_open
                ? Response::allow()
                : Response::deny('You are not allowed to delete contact messages.');
        });

        $ability = 'manage-website-settings';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission('has-admin-rights')
                ? Response::allow()
                : Response::deny('You are not allowed to manage the website settings.');
        });

        $ability = 'manage-convoys';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission($ability)
                ? Response::allow()
                : Response::deny('You are not allowed to manage convoys.');
        });

        $ability = 'delete-user';
        Gate::define($ability, function (User $user, User $targetUser) use ($ability) {
            return $user->hasPermission('has-admin-rights')
                && !$targetUser->hasPermission('has-admin-rights')
                ? Response::allow()
                : Response::deny('You are not allowed to delete this user.');
        });

        $ability = 'see-downloads';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission('see-downloads')
                ? Response::allow()
                : Response::deny('You are not allowed to see available downloads.');
        });
    }
}
