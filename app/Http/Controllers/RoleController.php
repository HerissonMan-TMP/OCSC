<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\UpdateRoleColorsRequest;
use App\Models\Permission;
use App\Models\Role;
use Gate;

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
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        Gate::authorize('update-permissions');

        $roles = Role::with('permissions')->orderBy('group_level')->orderBy('order')->get();
        $permissions = Permission::all();

        return view('roles-permissions.index')
                ->with(compact('roles'))
                ->with(compact('permissions'));
    }

    /**
     * Update the role colors.
     *
     * @param Role $role
     * @param UpdateRoleColorsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function updateColors(Role $role, UpdateRoleColorsRequest $request)
    {
        Gate::authorize('has-admin-rights');

        $role->update($request->validated());

        flash("You have successfully updated the colors of the role {$role->name}!")->success();

        return back();
    }
}
