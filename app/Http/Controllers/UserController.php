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
    /**
     * A User instance.
     *
     * @var User
     */
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display the staff members' list.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        Gate::authorize('see-staff-members-list');

        $users = User::with('roles')->get();

        return view('users.index')
                    ->with('users', $users);
    }

    /**
     * Display the user's profile and information.
     *
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(User $user)
    {
        Gate::authorize('see-staff-members-list');

        $user = $user->load('roles');
        $roles = Role::orderBy('order')->get();

        return view('users.show')
                ->with('user', $user)
                ->with('roles', $roles);
    }

    /**
     * Display the form to add a new user (staff member).
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Request $request)
    {
        Gate::authorize('create-new-users');

        $temporaryPassword = TemporaryPasswordService::generate();
        $roles = Role::orderBy('order')->get();

        return view('users.create')
                    ->with('email', $request->email)
                    ->with('temporaryPassword', $temporaryPassword)
                    ->with('roles', $roles);
    }

    /**
     * Store a new user (staff member).
     *
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreUserRequest $request)
    {
        Gate::authorize('create-new-users');
        Gate::authorize('assign-role', Role::find($request->role_id));

        $this->user->email = $request->email;
        $this->user->name = $request->name;
        $this->user->password = Hash::make($request->temporary_password);
        $this->user->temporary_password_without_hash = $request->temporary_password;
        $this->user->save();
        $this->user->roles()->attach($request->role_id);

        return redirect()->route('staff.staff-members-list');
    }

    /**
     * Update the temporary password of the authenticated user.
     *
     * @param UpdateTemporaryPasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateTemporaryPassword(UpdateTemporaryPasswordRequest $request)
    {
        $user = Auth::user();

        $user->password = Hash::make($request->password);
        $user->temporary_password_without_hash = null;
        $user->save();

        return redirect()->route('staff.hub');
    }

    /**
     * Update the roles of the given user.
     *
     * @param User $user
     * @param UpdateUserRolesRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function updateRoles(User $user, UpdateUserRolesRequest $request)
    {
        foreach ($request->roles as $roleId) {
            Gate::authorize('assign-role-to-user', [$user, Role::find($roleId)]);
        }

        $user->roles()->sync($request->roles);

        return back();
    }

    /**
     * Delete a user.
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(User $user)
    {
        Gate::authorize('delete-users');

        $user->recruitments()->delete();
        $user->roles()->detach();
        $user->delete();

        return redirect()->route('staff.staff-members-list');
    }
}
