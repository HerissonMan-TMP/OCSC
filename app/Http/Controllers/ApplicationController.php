<?php

namespace App\Http\Controllers;

use App\Http\Requests\Application\StoreApplicationRequest;
use App\Models\Answer;
use App\Models\Application;
use App\Models\Recruitment;
use Illuminate\Support\Facades\Gate;

class ApplicationController extends Controller
{
    /**
     * An Application instance.
     *
     * @var Application
     */
    protected $application;

    /**
     * An Answer instance.
     *
     * @var Answer
     */
    protected $answer;

    public function __construct(Application $application, Answer $answer)
    {
        $this->application = $application;
        $this->answer = $answer;
    }

    /**
     * Display all applications sent for a given recruitment session.
     *
     * @param Recruitment $recruitment
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Recruitment $recruitment)
    {
        Gate::authorize('manage-recruitments');

        $recruitment = $recruitment->load(['role', 'applications']);

        return view('applications.index')
                    ->with('recruitment', $recruitment);
    }

    /**
     * Display the application sent for the given recruitment session.
     *
     * @param Recruitment $recruitment
     * @param Application $application
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Recruitment $recruitment, Application $application)
    {
        Gate::authorize('manage-recruitments');

        $recruitment = $recruitment->load(['role', 'questions']);

        return view('applications.show')
                    ->with('recruitment', $recruitment)
                    ->with('application', $application);
    }

    /**
     * Store the user's application (his contact information and answers).
     *
     * @param Recruitment $recruitment
     * @param StoreApplicationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Recruitment $recruitment, StoreApplicationRequest $request)
    {
        // TODO: Refactor this.

        $this->application->fill($request->validated());
        $this->application->recruitment()->associate($recruitment->id);
        $this->application->save();

        $questionsId = $recruitment->questions()->pluck('id')->toArray();

        $answersSent = $request->except(['_token', 'discord_username', 'email_address']);

        foreach ($answersSent as $questionName => $text) {
            $questionId = str_replace('question_', '', $questionName);

            if (in_array($questionId, $questionsId)) {
                $this->answer->text = $text;
                $this->answer->application()->associate($application->id);
                $this->answer->question()->associate($questionId);
                $this->answer->save();
            }
        }

        return redirect()->route('applications.success-page');
    }

    /**
     * Accept an application, and redirects to the user creation page.
     *
     * @param Recruitment $recruitment
     * @param Application $application
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function accept(Recruitment $recruitment, Application $application)
    {
        Gate::authorize('manage-recruitments');

        $application->status = 'accepted';
        $application->save();

        return redirect()->route('staff.users.create', [
            'email' => $application->email,
            'role_id' => $application->recruitment->role->id
        ]);
    }

    /**
     * Decline an application, and redirect to the applications index.
     *
     * @param Recruitment $recruitment
     * @param Application $application
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function decline(Recruitment $recruitment, Application $application)
    {
        Gate::authorize('manage-recruitments');

        $application->status = 'declined';
        $application->save();

        return redirect()->route('staff.recruitments.applications.index', $recruitment);
    }
}
