<?php

namespace App\Http\Controllers;

use App\Http\Requests\Question\StoreQuestionRequest;
use App\Http\Requests\Question\UpdateQuestionRequest;
use App\Models\Question;
use App\Models\Recruitment;
use Illuminate\Http\Request;

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
        $question = new Question;

        $question->name = $request->name;
        $question->type = $request->type;
        $question->recruitment()->associate($recruitment->id);

        $question->save();

        return redirect()->route('staff.recruitments.edit', $recruitment);
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
        $question->name = $request->name;
        $question->type = $request->type;

        $question->save();

        return redirect()->route('staff.recruitments.edit', $recruitment);
    }

    public function destroy(Recruitment $recruitment, Question $question)
    {
        $question->delete();

        return redirect()->route('staff.recruitments.edit', $recruitment);
    }
}
