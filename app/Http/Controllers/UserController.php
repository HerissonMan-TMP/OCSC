<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateTemporaryPasswordRequest;
use App\Http\Requests\User\UpdateUserRolesRequest;
use App\Models\Application;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Services\TemporaryPasswordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        Gate::authorize('see-staff-members-list');

        $users = User::with('roles')->get();

        return view('staff.staff-members.index')
                    ->with('users', $users);
    }

    public function show(User $user)
    {
        $user = $user->load('roles');
        $roles = Role::orderBy('order')->get();

        return view('staff.user.show')
                ->with('user', $user)
                ->with('roles', $roles);
    }

    public function create(Request $request)
    {
        Gate::authorize('create-new-users');

        $temporaryPassword = TemporaryPasswordService::generate();
        $roles = Role::orderBy('order')->get();

        return view('staff.user.create')
                    ->with('email', $request->email)
                    ->with('temporaryPassword', $temporaryPassword)
                    ->with('roles', $roles);
    }

    public function store(StoreUserRequest $request)
    {
        Gate::authorize('create-new-users');
        Gate::authorize('assign-role', Role::find($request->role_id));

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->temporary_password);
        $user->has_temporary_password = true;
        $user->temporary_password_without_hash = $request->temporary_password;
        $user->save();

        $user->roles()->attach($request->role_id);

        return redirect()->route('staff.staff-members-list');
    }

    public function editTemporaryPassword()
    {
        return view('staff.edit-temporary-password');
    }

    public function updateTemporaryPassword(UpdateTemporaryPasswordRequest $request)
    {
        $user = Auth::user();

        $user->password = Hash::make($request->password);
        $user->has_temporary_password = false;
        $user->temporary_password_without_hash = null;

        $user->save();

        return redirect()->route('staff.hub');
    }

    public function updateRoles(User $user, UpdateUserRolesRequest $request)
    {
        foreach ($request->roles as $roleId) {
            Gate::authorize('assign-role-to-user', [$user, Role::find($roleId)]);
        }

        $user->roles()->sync($request->roles);

        return back();
    }
}
