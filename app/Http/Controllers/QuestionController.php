<?php

namespace App\Http\Controllers;

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
    public function store(Recruitment $recruitment, Request $request)
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
    public function update(Recruitment $recruitment, Question $question, Request $request)
    {
        $question->name = $request->name;
        $question->type = $request->type;

        $question->save();

        return redirect()->route('staff.recruitments.edit', $recruitment);
    }
}
