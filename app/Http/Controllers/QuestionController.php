<?php

namespace App\Http\Controllers;

use App\Http\Requests\Question\StoreQuestionRequest;
use App\Http\Requests\Question\UpdateQuestionRequest;
use App\Models\Question;
use App\Models\Recruitment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class QuestionController extends Controller
{
    /**
     * A Question instance.
     *
     * @var Question
     */
    protected $question;

    public function __construct(Question $question)
    {
        $this->question = $question;
    }

    /**
     * Store a question for the given recruitment session.
     *
     * @param Recruitment $recruitment
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Recruitment $recruitment, StoreQuestionRequest $request)
    {
        // TODO: Be able to configure the min and max length for a question.

        Gate::authorize('manage-recruitments');

        $this->question->fill($request->validated());

        if ($request->type === 'inline') {
            $this->question->min_length = 0;
            $this->question->max_length = 200;
        } else {
            $this->question->min_length = 200;
            $this->question->max_length = 5000;
        }

        $this->question->recruitment()->associate($recruitment->id);
        $this->question->save();

        return back();
    }

    /**
     * Update the question for the given recruitment session.
     *
     * @param Recruitment $recruitment
     * @param Question $question
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Recruitment $recruitment, Question $question, UpdateQuestionRequest $request)
    {
        Gate::authorize('manage-recruitments');

        $question->update($request->validated());

        return back();
    }

    /**
     * Delete the given question for the given recruitment session.
     *
     * @param Recruitment $recruitment
     * @param Question $question
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Recruitment $recruitment, Question $question)
    {
        Gate::authorize('manage-recruitments');

        $question->delete();

        return back();
    }
}
