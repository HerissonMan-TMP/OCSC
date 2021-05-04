<?php

namespace App\Http\Controllers;

use App\Filters\ApplicationFilters;
use App\Http\Requests\Application\StoreApplicationRequest;
use App\Models\ActivityType;
use App\Models\Answer;
use App\Models\Application;
use App\Models\Recruitment;
use Illuminate\Support\Facades\Gate;

/**
 * Class ApplicationController
 * @package App\Http\Controllers
 */
class ApplicationController extends Controller
{
    /**
     * Display all the applications sent for a given recruitment session.
     *
     * @param Recruitment $recruitment
     * @param ApplicationFilters $filters
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Recruitment $recruitment, ApplicationFilters $filters)
    {
        Gate::authorize('manage-recruitments');

        $recruitment = $recruitment->load('role');
        $applications = $recruitment->applications()->filter($filters)->get();

        return view('applications.index')
            ->with(compact('recruitment', 'applications'));
    }

    /**
     * Display the application sent for the given recruitment session.
     *
     * @param Application $application
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Application $application)
    {
        Gate::authorize('manage-recruitments');

        $application = $application->load(['recruitment.role', 'recruitment.questions']);

        return view('applications.show')
            ->with(compact('application'));
    }

    /**
     * Store the user's application along with his answers.
     *
     * @param Recruitment $recruitment
     * @param StoreApplicationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Recruitment $recruitment, StoreApplicationRequest $request)
    {
        Gate::authorize('apply-for-recruitment', $recruitment);

        $application = $recruitment->applications()->create($request->validated());

        foreach ($recruitment->questions as $index => $question) {
            $answer = new Answer();

            $answer->text = $request->questions[$index];

            $answer->application()->associate($application);
            $answer->question()->associate($question);

            $answer->save();
        }

        $role = $recruitment->role()->first();
        activity(ActivityType::APPLIED_FOR)
                ->byAnonymous()
                ->subject("fas fa-{$role->icon_name}", $role->name)
                ->description("Discord: {$application->discord}")
                ->log();

        flash("You have successfully sent your application for the {$recruitment->role->name} role!")->success();

        return redirect()->route('applications.success-page');
    }

    /**
     * Accept an application, and redirects to the user creation page.
     *
     * @param Application $application
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function accept(Application $application)
    {
        Gate::authorize('manage-recruitments');

        $application->update([
            'status' => Application::ACCEPTED,
        ]);

        activity(ActivityType::APPLICATION_ACCEPTED)
                ->subject("fas fa-briefcase", "Application #{$application->id}")
                ->description("From (Discord): {$application->discord}")
                ->log();

        flash("You have successfully accepted the application!")->success();

        return redirect()->route('staff.users.create', [
            'email' => $application->email,
            'role_id' => $application->recruitment->role->id
        ]);
    }

    /**
     * Decline an application, and redirect to the applications index.
     *
     * @param Application $application
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function decline(Application $application)
    {
        Gate::authorize('manage-recruitments');

        $application->update([
            'status' => Application::DECLINED,
        ]);

        activity(ActivityType::APPLICATION_DECLINED)
                ->subject("fas fa-briefcase", "Application #{$application->id}")
                ->description("From (Discord): {$application->discord}")
                ->log();

        flash("You have successfully declined the application!")->success();

        return redirect()->route('staff.recruitments.applications.index', $application->recruitment);
    }
}
