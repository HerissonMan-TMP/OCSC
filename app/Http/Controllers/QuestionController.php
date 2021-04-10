<?php

namespace App\Http\Controllers;

use App\Http\Requests\Question\StoreQuestionRequest;
use App\Http\Requests\Question\UpdateQuestionRequest;
use App\Models\Question;
use App\Models\Recruitment;
use Gate;

/**
 * Class QuestionController
 * @package App\Http\Controllers
 */
class QuestionController extends Controller
{
    /**
     * Store a question for the given recruitment session.
     *
     * @param Recruitment $recruitment
     * @param StoreQuestionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Recruitment $recruitment, StoreQuestionRequest $request)
    {
        Gate::authorize('manage-recruitments');

        $question = new Question;

        $question->fill($request->validated());

        if ($request->type === Question::INLINE) {
            $question->min_length = Question::INLINE_MIN_LENGTH;
            $question->max_length = Question::INLINE_MAX_LENGTH;
        } else {
            $question->min_length = Question::MULTILINE_MIN_LENGTH;
            $question->max_length = Question::MULTILINE_MAX_LENGTH;
        }

        $question->recruitment()->associate($recruitment->id);
        $question->save();

        return back();
    }

    /**
     * Update the given question.
     *
     * @param Recruitment $recruitment
     * @param Question $question
     * @param UpdateQuestionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Question $question, UpdateQuestionRequest $request)
    {
        Gate::authorize('manage-recruitments');

        $question->update($request->validated());

        return back();
    }

    /**
     * Delete the given question.
     *
     * @param Recruitment $recruitment
     * @param Question $question
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Question $question)
    {
        Gate::authorize('manage-recruitments');

        $question->delete();

        return back();
    }
}
