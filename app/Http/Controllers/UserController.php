<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateTemporaryPasswordRequest;
use App\Models\Application;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();

        return view('staff.staff-members.index')
                    ->with('users', $users);
    }

    public function create(Request $request)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $temporary_password = substr(str_shuffle($characters), 0, 8);
        $roles = Role::all();

        return view('staff.user.create')
                    ->with('email', $request->email)
                    ->with('temporary_password', $temporary_password)
                    ->with('roles', $roles);
    }

    public function store(StoreUserRequest $request)
    {
        //Ensure the email doesn't already exist.

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->temporary_password);
        $user->has_temporary_password = true;
        $user->temporary_password_without_hash = $request->temporary_password;
        $user->save();

        $user->roles()->attach($request->role_id);

        return redirect()->route('staff.staff-members-management');
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
}
