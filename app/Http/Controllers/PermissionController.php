<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
    public function update(Role $role, Request $request)
    {
        Gate::authorize('has-admin-rights');

        $role->permissions()->sync($request->permissions);

        return redirect()->route('staff.hub');
    }
}
