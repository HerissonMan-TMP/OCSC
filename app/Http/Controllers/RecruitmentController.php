<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Recruitment\StoreRecruitmentRequest;
use App\Http\Requests\Recruitment\UpdateRecruitmentRequest;
use App\Models\Recruitment;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class RecruitmentController extends Controller
{
    /**
     * Display all recruitment sessions (open or closed).
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
     * Display the view of the given recruitment session where users can apply.
     *
     * @param Recruitment $recruitment
     */
    public function show(Recruitment $recruitment)
    {
        //Check if recruitment open

        $recruitment = $recruitment->load(['role', 'questions']);

        return view('recruitments.show')
                    ->with('recruitment', $recruitment);
    }

    /**
     * Display the view to store a recruitment session.
     */
    public function create()
    {
        Gate::authorize('manage-recruitments');

        $roles = Role::recruitable()->NotCurrentlyRecruiting()->get();

        return view('recruitments.create')
                    ->with('recruitableRolesNotCurrentlyRecruiting', $roles);
    }

    /**
     * Store a recruitment session.
     *
     * @param StoreRecruitmentRequest $request
     */
    public function store(StoreRecruitmentRequest $request)
    {
        Gate::authorize('manage-recruitments');

        $recruitment = new Recruitment;

        $recruitment->start_at = $request->start_datetime;
        $recruitment->end_at = $request->end_datetime;
        $recruitment->note = $request->note;
        $recruitment->role()->associate($request->role_id);
        $recruitment->user()->associate(Auth::user()->id);

        $recruitment->save();

        return redirect()->route('staff.recruitments.edit', $recruitment);
    }

    /**
     * Display the view to update basic information of the given recruitment session.
     *
     * @param Recruitment $recruitment
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
     */
    public function update(UpdateRecruitmentRequest $request, Recruitment $recruitment)
    {
        Gate::authorize('manage-recruitments');

        $recruitment->start_at = $request->start_datetime;
        $recruitment->end_at = $request->end_datetime;
        $recruitment->note = $request->note;

        $recruitment->save();

        return redirect()->route('staff.recruitment-management');
    }

    /**
     * Delete the given recruitment session.
     *
     * @param Recruitment $recruitment
     */
    public function destroy(Recruitment $recruitment)
    {
        Gate::authorize('manage-recruitments');

        $recruitment->delete();

        return redirect()->route('staff.recruitment-management');
    }
}
