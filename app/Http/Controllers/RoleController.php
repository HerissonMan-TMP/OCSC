<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\UpdateRoleColorsRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
                ->with('roles', $roles)
                ->with('permissions', $permissions);
    }

    public function updateColors(UpdateRoleColorsRequest $request, Role $role)
    {
        Gate::authorize('has-admin-rights');

        $role->update($request->validated());

        return back();
    }
}
