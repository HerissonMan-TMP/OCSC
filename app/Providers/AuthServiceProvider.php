<?php

namespace App\Providers;

use App\Models\Convoy;
use App\Models\Download;
use App\Models\Guide;
use App\Models\Permission;
use App\Models\Picture;
use App\Models\Recruitment;
use App\Models\Role;
use App\Models\Subscriber;
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
            'update-name-of-user',
            'update-email-of-user',
            'update-password-of-user',
            'reset-temporary-password-of-user',
            'assign-roles-to-user',
            'update-permissions-of-role',
            'delete-user'
        ];
        Gate::before(function (User $user, $ability) use ($abilitiesWithoutBypass) {
            if (
                !in_array($ability, $abilitiesWithoutBypass)
                && $user->hasPermission('has-admin-rights')
            ) {
                return true;
            }
        });

        $ability = 'has-admin-rights';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission($ability)
                ? Response::allow()
                : Response::deny('You do not have admin rights.');
        });


        //Convoys.
        $ability = 'manage-convoys';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission($ability)
                ? Response::allow()
                : Response::deny('You are not allowed to manage convoys.');
        });

        $ability = 'edit-convoy-rules';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission($ability)
                ? Response::allow()
                : Response::deny('You are not allowed to edit the convoy rules.');
        });


        //News articles.
        $ability = 'manage-news-articles';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission($ability)
                ? Response::allow()
                : Response::deny('You are not allowed to manage news articles.');
        });


        //Partners.
        $ability = 'manage-partners';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission($ability)
                ? Response::allow()
                : Response::deny('You are not allowed to manage partners.');
        });

        $ability = 'edit-partnership-conditions-and-info';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission($ability)
                ? Response::allow()
                : Response::deny('You are not allowed to edit the partnership conditions & information.');
        });

        $ability = 'manage-partner-categories';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission($ability)
                ? Response::allow()
                : Response::deny('You are not allowed to manage the partner categories.');
        });

        //Gallery.
        $ability = 'manage-pictures';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission($ability)
                ? Response::allow()
                : Response::deny('You are not allowed to manage pictures.');
        });

        $ability = 'add-pictures-to-gallery';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission($ability) || $user->can('manage-pictures')
                ? Response::allow()
                : Response::deny('You are not allowed to add pictures to the gallery.');
        });

        $ability = 'manage-picture';
        Gate::define($ability, function (User $user, Picture $picture) use ($ability) {
            return $user->can('manage-pictures') || $picture->user->is($user)
                ? Response::allow()
                : Response::deny('You are not allowed to manage this picture.');
        });


        //Downloads.
        $ability = 'manage-downloads';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission($ability)
                ? Response::allow()
                : Response::deny('You are not allowed to manage downloads.');
        });

        $ability = 'download-file';
        Gate::define($ability, function (User $user, Download $download) use ($ability) {
            return Download::accessible()->get()->contains($download) || $user->hasPermission('manage-downloads')
                ? Response::allow()
                : Response::deny('You are not allowed to download this file.');
        });


        //Guides.
        $ability = 'manage-guides';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission($ability)
                ? Response::allow()
                : Response::deny('You are not allowed to manage guides.');
        });

        $ability = 'read-guide';
        Gate::define($ability, function (User $user, Guide $guide) use ($ability) {
            return Guide::accessible()->get()->contains($guide) || $user->can('manage-guides')
                ? Response::allow()
                : Response::deny('You are not allowed to read this guide.');
        });


        //Contact messages.
        $ability = 'manage-contact-messages';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission($ability)
                ? Response::allow()
                : Response::deny('You are not allowed to manage contact messages.');
        });


        //Recruitments.
        $ability = 'manage-recruitments';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission($ability)
                ? Response::allow()
                : Response::deny('You are not allowed to manage recruitments.');
        });

        $ability = 'manage-applications';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission($ability)
                ? Response::allow()
                : Response::deny('You are not allowed to manage applications.');
        });

        $ability = 'edit-global-requirements';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission($ability)
                ? Response::allow()
                : Response::deny('You are not allowed to edit the global requirements.');
        });

        $ability = 'apply-for-recruitment';
        Gate::define($ability, function (?User $user, Recruitment $recruitment) use ($ability) {
            return $recruitment->is_open
                ? Response::allow()
                : Response::deny('You are not allowed to apply for this recruitment.');
        });

        //Staff members.
        $ability = 'add-staff-members';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission('add-staff-members')
                ? Response::allow()
                : Response::deny('You are not allowed to add new Staff members.');
        });

        $ability = 'delete-user';
        Gate::define($ability, function (User $user, User $targetUser) use ($ability) {
            return $user->hasPermission('has-admin-rights')
                && !$targetUser->hasPermission('has-admin-rights')
                ? Response::allow()
                : Response::deny('You are not allowed to delete this user.');
        });

        $ability = 'see-email-address-of-staff-members';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission($ability)
                ? Response::allow()
                : Response::deny('You are not allowed to see the email address of Staff members.');
        });

        $ability = 'see-temporary-password-of-new-staff-members';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission($ability)
                ? Response::allow()
                : Response::deny('You are not allowed to see the new Staff members\' temporary password.');
        });

        $ability = 'update-name-of-user';
        Gate::define($ability, function (User $user, User $targetUser) {
            return $user->is($targetUser)
                || ($user->can('has-admin-rights') && !$targetUser->can('has-admin-rights'))
                ? Response::allow()
                : Response::deny('You are not allowed to update the name of this user.');
        });

        $ability = 'update-email-of-user';
        Gate::define($ability, function (User $user, User $targetUser) {
            return $user->is($targetUser)
                || ($user->can('has-admin-rights') && !$targetUser->can('has-admin-rights'))
                ? Response::allow()
                : Response::deny('You are not allowed to update the email of this user.');
        });

        $ability = 'update-password-of-user';
        Gate::define($ability, function (User $user, User $targetUser) {
            return $user->is($targetUser)
                ? Response::allow()
                : Response::deny('You are not allowed to update the password of this user.');
        });

        $ability = 'reset-temporary-password-of-user';
        Gate::define($ability, function (User $user, User $targetUser) {
            return $user->can('has-admin-rights')
                && !$targetUser->can('has-admin-rights')
                ? Response::allow()
                : Response::deny('You are not allowed to reset the password of this user.');
        });


        //Roles & Permissions.
        $ability = 'assign-roles';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission('assign-roles')
                ? Response::allow()
                : Response::deny('You are not allowed to assign roles.');
        });

        $ability = 'assign-role';
        Gate::define($ability, function (User $user, Role $role) use ($ability) {
            return $user->can('assign-roles')
            && $user->roles->first()->group->id < $role->group->id
                ? Response::allow()
                : Response::deny('You are not allowed to assign that role.');
        });

        $ability = 'assign-roles-to-user';
        Gate::define($ability, function (User $user, User $targetUser) use ($ability) {
            return ($user->can('has-admin-rights')
                || (
                    $user->can('assign-roles')
                    && $user->roles->first()->group->id < $targetUser->roles->first()->group->id
                )
                && !$targetUser->can('has-admin-rights'))
                ? Response::allow()
                : Response::deny('You are not allowed to assign roles for this user.');
        });

        $ability = 'update-roles';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->can('has-admin-rights')
                ? Response::allow()
                : Response::deny('You are not allowed to update the roles.');
        });

        $ability = 'update-permissions-of-role';
        Gate::define($ability, function (User $user, Role $targetRole) use ($ability) {
            return $user->can('has-admin-rights')
                && !$targetRole->hasPermission('has-admin-rights')
                ? Response::allow()
                : Response::deny('You are not allowed to update the permissions for this role.');
        });


        //Website settings.
        $ability = 'see-activity';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission($ability)
                ? Response::allow()
                : Response::deny('You are not allowed to see the Staff members\' activity.');
        });

        $ability = 'edit-legal-notice';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission($ability)
                ? Response::allow()
                : Response::deny('You are not allowed to edit the legal notice.');
        });

        $ability = 'edit-privacy-policy';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission($ability)
                ? Response::allow()
                : Response::deny('You are not allowed to edit the privacy policy.');
        });

        $ability = 'see-statistics';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission($ability)
                ? Response::allow()
                : Response::deny('You are not allowed to see the statistics.');
        });

        $ability = 'see-error-logs';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission($ability)
                ? Response::allow()
                : Response::deny('You are not allowed to see the error logs.');
        });

        $ability = 'toggle-maintenance-mode';
        Gate::define($ability, function (User $user) use ($ability) {
            return $user->hasPermission($ability)
                ? Response::allow()
                : Response::deny('You are not allowed to toggle the maintenance mode.');
        });
    }
}
