<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\UpdateRoleRequest;
use App\Models\ActivityType;
use App\Models\Group;
use App\Models\PermissionCategory;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

/**
 * Class RoleController
 * @package App\Http\Controllers
 */
class RoleController extends Controller
{
    /**
     * Display the roles list.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $roles = Role::orderBy('group_id')->orderBy('order')->get();
        $groups = Group::with('roles')->get();

        return view('roles.index')
                ->with(compact('roles'))
                ->with(compact('groups'));
    }

    /**
     * Display the form to edit the given role.
     *
     * @param Role $role
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Role $role)
    {
        Gate::authorize('update-roles');

        return view('roles.edit')
                ->with(compact('role'));
    }

    /**
     * Update the given role.
     *
     * @param Role $role
     * @param UpdateRoleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Role $role, UpdateRoleRequest $request)
    {
        Gate::authorize('update-roles');

        $role->update($request->validated());

        activity(ActivityType::UPDATED)
            ->subject("fas fa-{$role->icon_name}", $role->name)
            ->log();

        flash("You have successfully updated the role {$role->name}!")->success();

        return redirect()->route('staff.roles.index');
    }

    /**
     * Display the form to edit the permissions of the given role.
     *
     * @param Role $role
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function editPermissions(Role $role)
    {
        Gate::authorize('update-permissions-of-role', $role);

        $role = $role->load('permissions');
        $permissionCategories = PermissionCategory::with('permissions')->get();

        return view('roles.edit-permissions')
                ->with(compact('role'))
                ->with(compact('permissionCategories'));
    }

    /**
     * Update the permissions of the given role.
     *
     * @param Role $role
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function updatePermissions(Role $role, Request $request)
    {
        Gate::authorize('update-permissions-of-role', $role);

        $role->permissions()->sync($request->permissions);

        activity(ActivityType::UPDATED)
            ->subject("fas fa-shield-alt", "{$role->name}'s permissions")
            ->log();

        flash("You have successfully updated the permissions of the role {$role->name}!")->success();

        return redirect()->route('staff.roles.index');
    }
}
