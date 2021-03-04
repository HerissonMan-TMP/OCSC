<?php

namespace App\Http\Controllers;

use App\Http\Requests\Application\StoreApplicationRequest;
use App\Models\Answer;
use App\Models\Application;
use App\Models\Recruitment;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Display all applications sent for a given recruitment session.
     *
     * @param Recruitment $recruitment
     */
    public function index(Recruitment $recruitment)
    {
        $recruitment = $recruitment->load(['role', 'applications']);

        return view('staff.recruitment.application.index')
                    ->with('recruitment', $recruitment);
    }

    /**
     * Display the application of the given recruitment session.
     *
     * @param Recruitment $recruitment
     * @param Application $application
     */
    public function show(Recruitment $recruitment, Application $application)
    {
        $recruitment = $recruitment->load(['role', 'questions']);
        return view('staff.recruitment.application.show')
                    ->with('recruitment', $recruitment)
                    ->with('application', $application);
    }

    /**
     * Store the user's contact information and his answers.
     *
     * @param Recruitment $recruitment
     * @param StoreApplicationRequest $request
     */
    public function store(Recruitment $recruitment, StoreApplicationRequest $request)
    {
        $application = new Application;

        $application->discord = $request->discord_username;
        $application->email = $request->email_address;
        $application->recruitment()->associate($recruitment->id);

        $application->save();

        $questions = $recruitment->questions()->pluck('id')->toArray();

        $answers = $request->except(['_token', 'discord_username', 'email_address']);

        foreach ($answers as $question_name => $text) {
            $question_id = str_replace('question_', '', $question_name);

            if (in_array($question_id, $questions)) {
                $answer = new Answer;

                $answer->text = $text;
                $answer->application()->associate($application->id);
                $answer->question()->associate($question_id);

                $answer->save();
            }
        }

        return redirect()->route('recruitments.showSuccess');
    }

    public function accept(Recruitment $recruitment, Application $application)
    {
        //Check if status is new

        $application->status = 'accepted';
        $application->save();

        return redirect()->route('staff.users.create', [
            'email' => $application->email,
            'role_id' => $application->recruitment->role->id
        ]);
    }

    public function decline(Recruitment $recruitment, Application $application)
    {
        //Check if status is new

        $application->status = 'declined';
        $application->save();

        return redirect()->route('staff.recruitments.applications.index', $recruitment);
    }
}
