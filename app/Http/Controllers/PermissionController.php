<?php

namespace App\Http\Controllers;

use App\Http\Requests\Permission\UpdatePermissionRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
    public function update(Role $role, UpdatePermissionRequest $request)
    {
        foreach ($request->permissions as $permissionId) {
            Gate::authorize('update-permission-for-role', [$role, Permission::find($permissionId)]);
        }

        $role->permissions()->sync($request->permissions);

        return redirect()->route('staff.hub');
    }
}
