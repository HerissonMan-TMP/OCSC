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
     * Store a question for the given recruitment session.
     *
     * @param Recruitment $recruitment
     * @param Request $request
     */
    public function store(Recruitment $recruitment, StoreQuestionRequest $request)
    {
        Gate::authorize('manage-recruitments');

        $question = new Question;

        $question->name = $request->name;
        $question->type = $request->type;
        if ($request->type === 'inline') {
            $question->min_length = 0;
            $question->min_length = 200;
        } else {
            $question->min_length = 200;
            $question->min_length = 5000;
        }
        $question->recruitment()->associate($recruitment->id);

        $question->save();

        return back();
    }

    /**
     * Update the question for the given recruitment session.
     *
     * @param Recruitment $recruitment
     * @param Question $question
     * @param Request $request
     */
    public function update(Recruitment $recruitment, Question $question, UpdateQuestionRequest $request)
    {
        Gate::authorize('manage-recruitments');

        $question->name = $request->name;
        $question->type = $request->type;

        $question->save();

        return back();
    }

    public function destroy(Recruitment $recruitment, Question $question)
    {
        Gate::authorize('manage-recruitments');

        $question->delete();

        return back();
    }
}
