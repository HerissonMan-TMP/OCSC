<?php

namespace App\Http\Controllers;

use App\Http\Requests\Question\StoreQuestionRequest;
use App\Http\Requests\Question\UpdateQuestionRequest;
use App\Models\ActivityType;
use App\Models\Question;
use App\Models\Recruitment;
use Illuminate\Support\Facades\Gate;

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

        activity(ActivityType::CREATED)
            ->subject("fas fa-question-circle", "Question #{$question->id}")
            ->description("Name: {$question->name}")
            ->log();

        flash("You have successfully added a new question!")->success();

        return back();
    }

    /**
     * Update the given question.
     *
     * @param Question $question
     * @param UpdateQuestionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Question $question, UpdateQuestionRequest $request)
    {
        Gate::authorize('manage-recruitments');

        $question->update($request->validated());

        activity(ActivityType::UPDATED)
            ->subject("fas fa-question-circle", "Question #{$question->id}")
            ->description("Name: {$question->name}")
            ->log();

        flash("You have successfully updated the question '{$question->name}'!")->success();

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

        activity(ActivityType::DELETED)
            ->subject("fas fa-question-circle", "Question #{$question->id}")
            ->description("Name: {$question->name}")
            ->log();

        flash("You have successfully deleted the question '{$question->name}'!")->success();

        return back();
    }
}
