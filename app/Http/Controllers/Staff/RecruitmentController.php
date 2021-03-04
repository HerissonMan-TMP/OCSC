<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Recruitment\StoreRecruitmentRequest;
use App\Http\Requests\Recruitment\UpdateRecruitmentRequest;
use App\Models\Recruitment;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecruitmentController extends Controller
{
    /**
     * Display all recruitment sessions (open or closed).
     */
    public function index()
    {

        $recruitments = Recruitment::latest()
                                    ->with([
                                        'role',
                                        'user',
                                        'user.roles'
                                    ])
                                    ->withCount('applications')->get();

        return view('staff.recruitment.index')
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

        return view('recruitment.show')
                    ->with('recruitment', $recruitment);
    }

    /**
     * Display the success page, after the application has been submitted.
     */
    public function showSuccess()
    {
        return view('recruitment.success-page');
    }

    /**
     * Display the view to store a recruitment session.
     */
    public function create()
    {
        $roles = Role::recruitable()->NotCurrentlyRecruiting()->get();

        return view('staff.recruitment.create')
                    ->with('recruitableRolesNotCurrentlyRecruiting', $roles);
    }

    /**
     * Store a recruitment session.
     *
     * @param StoreRecruitmentRequest $request
     */
    public function store(StoreRecruitmentRequest $request)
    {
        $recruitment = new Recruitment;

        $recruitment->start_at = $request->start_datetime;
        $recruitment->end_at = $request->end_datetime;
        $recruitment->note = $request->note;
        $recruitment->role()->associate($request->role_id);
        $recruitment->user()->associate(Auth::user()->id);

        $recruitment->save();

        return redirect()->route('staff.recruitment-management');
    }

    /**
     * Display the view to update basic information of the given recruitment session.
     *
     * @param Recruitment $recruitment
     */
    public function edit(Recruitment $recruitment)
    {
        $recruitment = $recruitment->load(['role', 'questions', 'user.roles']);

        return view('staff.recruitment.edit')
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
        $recruitment->delete();

        return redirect()->route('staff.recruitment-management');
    }
}
