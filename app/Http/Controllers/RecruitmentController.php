<?php

namespace App\Http\Controllers;

use App\Http\Requests\Recruitment\StoreRecruitmentRequest;
use App\Http\Requests\Recruitment\UpdateRecruitmentRequest;
use App\Models\ActivityType;
use App\Models\Recruitment;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

/**
 * Class RecruitmentController
 * @package App\Http\Controllers
 */
class RecruitmentController extends Controller
{
    /**
     * Display the list of recruitment sessions (both open and closed).
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        Gate::authorize('manage-recruitments');

        $recruitments = Recruitment::latest()
                                    ->with([
                                        'role',
                                        'user',
                                        'user.roles'
                                    ])
                                    ->withCount('applications')->get();

        return view('recruitments.index')
                    ->with(compact('recruitments'));
    }

    /**
     * Display the given recruitment session's form where users can apply.
     *
     * @param Recruitment $recruitment
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Recruitment $recruitment)
    {
        Gate::authorize('apply-for-recruitment', $recruitment);

        $recruitment = $recruitment->load(['role', 'questions']);

        return view('recruitments.show')
                    ->with(compact('recruitment'));
    }

    /**
     * Display the form to store a recruitment session.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        Gate::authorize('manage-recruitments');

        $roles = Role::recruitable()->notCurrentlyRecruiting()->get();

        return view('recruitments.create')
                    ->with('recruitableRolesNotCurrentlyRecruiting', $roles);
    }

    /**
     * Store a recruitment session in the database.
     *
     * @param StoreRecruitmentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreRecruitmentRequest $request)
    {
        Gate::authorize('manage-recruitments');

        $recruitment = new Recruitment;

        $recruitment->fill($request->validated());
        $recruitment->user()->associate(Auth::user());
        $recruitment->role()->associate($request->role_id);

        $recruitment->save();

        activity(ActivityType::CREATED)
            ->subject("fas fa-briefcase", "Recruitment #{$recruitment->id}")
            ->description("Role: {$recruitment->role()->first()->name}")
            ->log();

        flash("You have successfully created a new recruitment session for the {$recruitment->role->name} role!")->success();

        return redirect()->route('staff.recruitments.index');
    }

    /**
     * Display the form to edit information & questions of the given recruitment session.
     *
     * @param Recruitment $recruitment
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Recruitment $recruitment)
    {
        Gate::authorize('manage-recruitments');

        $recruitment = $recruitment->load(['role', 'questions', 'user.roles']);

        return view('recruitments.edit')
                ->with(compact('recruitment'));
    }

    /**
     * Update basic information of the given recruitment session.
     *
     * @param Recruitment $recruitment
     * @param UpdateRecruitmentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Recruitment $recruitment, UpdateRecruitmentRequest $request)
    {
        Gate::authorize('manage-recruitments');

        $recruitment->update($request->validated());

        activity(ActivityType::UPDATED)
            ->subject("fas fa-briefcase", "Recruitment #{$recruitment->id}")
            ->description("Role: {$recruitment->role()->first()->name}")
            ->log();

        flash("You have successfully updated a recruitment session for the {$recruitment->role->name} role!")->success();

        return redirect()->route('staff.recruitments.index');
    }

    /**
     * Delete the given recruitment session.
     *
     * @param Recruitment $recruitment
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Recruitment $recruitment)
    {
        Gate::authorize('manage-recruitments');

        $recruitment->delete();

        activity(ActivityType::DELETED)
            ->subject("fas fa-briefcase", "Recruitment #{$recruitment->id}")
            ->description("Role: {$recruitment->role()->first()->name}")
            ->log();

        flash("You have successfully deleted a recruitment session for the {$recruitment->role->name} role!")->success();

        return redirect()->route('staff.recruitments.index');
    }
}
