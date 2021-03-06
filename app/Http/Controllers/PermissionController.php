<?php

namespace App\Http\Controllers;

use App\Http\Requests\Permission\UpdatePermissionRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
    public function update(Role $role, UpdatePermissionRequest $request)
    {
        Gate::authorize('update-permissions-for-role', $role);

        $role->permissions()->sync($request->permissions);

        return redirect()->route('staff.hub');
    }
}
