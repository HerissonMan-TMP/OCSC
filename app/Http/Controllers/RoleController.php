<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    public function index()
    {
        Gate::authorize('has-admin-rights');

        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();

        return view('staff.role-permission.index')
                ->with('roles', $roles)
                ->with('permissions', $permissions);
    }
}
