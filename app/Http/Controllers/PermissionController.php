<?php

namespace App\Http\Controllers;

use App\Http\Requests\Permission\UpdatePermissionRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
    /**
     * Update permissions for a given role.
     *
     * @param Role $role
     * @param UpdatePermissionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Role $role, UpdatePermissionRequest $request)
    {
        foreach ($request->permissions as $permissionId) {
            Gate::authorize('update-permission-for-role', [$role, Permission::find($permissionId)]);
        }

        $role->permissions()->sync($request->permissions);

        return redirect()->route('staff.hub');
    }
}
