<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
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

        $recruitments = Recruitment::latest()->withCount('applications')->get();

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

        $questions = $recruitment->questions()->get();

        return view('recruitment.show')
                    ->with('recruitment', $recruitment)
                    ->with('questions', $questions);
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
        $recruitableRoles = Role::recruitable()->get();

        return view('staff.recruitment.create')
                    ->with('roles', $recruitableRoles);
    }

    /**
     * Store a recruitment session.
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        if (Recruitment::where('role_id', $request->role)->open()->exists()) {
            abort(403);
        }

        $recruitment = new Recruitment;

        $recruitment->start_at = $request->start_datetime;
        $recruitment->end_at = $request->end_datetime;
        $recruitment->note = $request->note;
        $recruitment->role()->associate($request->role);
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
        $recruitableRoles = Role::recruitable()->get();
        $questions = $recruitment->questions()->get();

        return view('staff.recruitment.edit')
                ->with('recruitment', $recruitment)
                ->with('roles', $recruitableRoles)
                ->with('questions', $questions);
    }

    /**
     * Update basic information of the given recruitment session.
     *
     * @param Request $request
     * @param Recruitment $recruitment
     */
    public function update(Request $request, Recruitment $recruitment)
    {
        if (($recruitment->is_open && $request->role != $recruitment->role_id)) {
            abort(403);
        }

        $recruitment->start_at = $request->start_datetime;
        $recruitment->end_at = $request->end_datetime;
        $recruitment->note = $request->note;
        $recruitment->role()->associate($request->role);
        $recruitment->user()->associate(Auth::user()->id);

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
