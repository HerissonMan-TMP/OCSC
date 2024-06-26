<?php

namespace App\Http\Controllers;

use App\Filters\UserFilters;
use App\Http\Requests\User\ResetTemporaryPasswordRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateEmailRequest;
use App\Http\Requests\User\UpdateNameRequest;
use App\Http\Requests\User\UpdatePasswordRequest;
use App\Http\Requests\User\UpdateTemporaryPasswordRequest;
use App\Http\Requests\User\UpdateUserRolesRequest;
use App\Models\ActivityType;
use App\Models\Role;
use App\Models\User;
use App\Services\TemporaryPasswordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * Display the staff members' list.
     *
     * @param UserFilters $filters
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(UserFilters $filters)
    {
        $users = User::filter($filters)->with('roles')->paginate(20);
        $roles = Role::all();

        return view('users.index')
            ->with(compact('users', 'roles'));
    }

    /**
     * Display the user's profile and information.
     *
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(User $user)
    {
        $user = $user->load('roles');
        $roles = Role::orderBy('order')->get();
        $latestActivities = $user->activities()->latest()->take(3)->with('type')->get();
        $temporaryPassword = TemporaryPasswordService::generate();

        return view('users.show')
            ->with(compact('user', 'roles', 'latestActivities', 'temporaryPassword'));
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
        Gate::authorize('add-staff-members');

        $email = $request->email;

        $temporaryPassword = TemporaryPasswordService::generate();

        $roles = Role::orderBy('order')->get();

        return view('users.create')
            ->with(compact('email', 'temporaryPassword', 'roles'));
    }

    /**
     * Store a new user in the database.
     *
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreUserRequest $request)
    {
        Gate::authorize('add-staff-members');
        Gate::authorize('assign-role', Role::find($request->role_id));

        $user = new User();

        $user->fill($request->only('email', 'name', 'password'));
        $user->temporary_password_without_hash = $request->password;

        $user->save();

        $user->roles()->attach($request->role_id);

        activity(ActivityType::CREATED)
                ->subject('fas fa-user', $user->name)
                ->log();

        flash("You have successfully added a new user ({$user->name})!")->success();

        return redirect()->route('staff.users.index');
    }

    /**
     * Update the name of the given user.
     *
     * @param User $user
     * @param UpdateNameRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function updateName(User $user, UpdateNameRequest $request)
    {
        Gate::authorize('update-name-of-user', $user);

        $user->update($request->validated());

        activity(ActivityType::UPDATED)
            ->subject('fas fa-user', "{$user->name}")
            ->description("Name changed: {$user->name}")
            ->log();

        flash("You have successfully changed the name to {$user->name}!")->success();

        return back();
    }

    /**
     * Update the email of the given user.
     *
     * @param User $user
     * @param UpdateEmailRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function updateEmail(User $user, UpdateEmailRequest $request)
    {
        Gate::authorize('update-email-of-user', $user);

        $user->update($request->validated());

        activity(ActivityType::UPDATED)
            ->subject('fas fa-user', "{$user->name}")
            ->description("Email changed: {$user->email}")
            ->log();

        flash("You have successfully changed the email to {$user->email}!")->success();

        return back();
    }

    /**
     * Update the password of the given user.
     *
     * @param User $user
     * @param UpdatePasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function updatePassword(User $user, UpdatePasswordRequest $request)
    {
        Gate::authorize('update-password-of-user', $user);

        $user->update($request->validated());

        activity(ActivityType::UPDATED)
            ->subject('fas fa-user', "{$user->name}")
            ->description('Password changed')
            ->log();

        flash("You have successfully changed the password!")->success();

        return back();
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

        $user->password = $request->password;
        $user->temporary_password_without_hash = null;
        $user->save();

        activity(ActivityType::UPDATED)
                ->subject('fas fa-lock', 'Temporary password')
                ->log();

        flash("You have successfully updated your password!")->success();

        return redirect()->route('staff.hub');
    }

    /**
     * Reset the temporary password of the given user.
     *
     * @param User $user
     * @param ResetTemporaryPasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function resetTemporaryPassword(User $user, ResetTemporaryPasswordRequest $request)
    {
        Gate::authorize('reset-temporary-password-of-user', $user);

        $user->password = $request->password;
        $user->temporary_password_without_hash = $request->password;
        $user->save();

        activity(ActivityType::UPDATED)
            ->subject('fas fa-user', $user->name)
            ->description('Temporary password reset')
            ->log();

        flash("You have successfully reset the temporary password of {$user->name}!")->success();

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
        Gate::authorize('assign-roles-to-user', $user);

        foreach ($request->roles as $roleId) {
            Gate::authorize('assign-role', Role::find($roleId));
        }

        $user->roles()->sync($request->roles);

        $newRoles = implode(', ', $user->roles()->pluck('name')->toArray());
        activity(ActivityType::UPDATED)
                ->subject('fas fa-user', $user->name)
                ->description("New roles: {$newRoles}")
                ->log();

        flash("You have successfully updated the roles of {$user->name}!")->success();

        return back();
    }

    /**
     * Delete the given user.
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(User $user)
    {
        Gate::authorize('delete-users');

        foreach($user->recruitments() as $recruitment) {
            $recruitment->user()->dissociate();
        }
        $user->roles()->detach();
        $user->delete();

        activity(ActivityType::DELETED)
                ->subject('fas fa-user', $user->name)
                ->log();

        flash("You have successfully deleted the user '{$user->name}'!")->success();

        return redirect()->route('staff.users.index');
    }
}
