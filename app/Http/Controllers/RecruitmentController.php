<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Recruitment\StoreRecruitmentRequest;
use App\Http\Requests\Recruitment\UpdateRecruitmentRequest;
use App\Models\Recruitment;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class RecruitmentController extends Controller
{
    /**
     * A Recruitment instance.
     *
     * @var Recruitment
     */
    protected $recruitment;

    public function __construct(Recruitment $recruitment)
    {
        $this->recruitment = $recruitment;
    }

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
                    ->with('recruitments', $recruitments);
    }

    /**
     * Display the given recruitment session's form where users can apply.
     *
     * @param Recruitment $recruitment
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Recruitment $recruitment)
    {
        $recruitment = $recruitment->load(['role', 'questions']);

        return view('recruitments.show')
                    ->with('recruitment', $recruitment);
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
     * Store a recruitment session.
     *
     * @param StoreRecruitmentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreRecruitmentRequest $request)
    {
        Gate::authorize('manage-recruitments');

        $this->recruitment->fill($request->validated());
        $this->recruitment->user()->associate(Auth::user()->id);
        $this->recruitment->save();

        return redirect()->route('staff.recruitments.edit', $recruitment);
    }

    /**
     * Display the form to update basic information of the given recruitment session.
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
                ->with('recruitment', $recruitment);
    }

    /**
     * Update basic information of the given recruitment session.
     *
     * @param UpdateRecruitmentRequest $request
     * @param Recruitment $recruitment
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateRecruitmentRequest $request, Recruitment $recruitment)
    {
        Gate::authorize('manage-recruitments');

        $recruitment->update($request->validated());

        return redirect()->route('staff.recruitment-management');
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

        return redirect()->route('staff.recruitment-management');
    }
}
