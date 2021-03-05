<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function update(Role $role, Request $request)
    {
        $role->permissions()->sync($request->permissions);

        return redirect()->route('staff.hub');
    }
}
