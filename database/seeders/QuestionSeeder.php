<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->truncate();

        //(#1) Inline question for recruitment 1 (Media Team): "How old are you?".
        $question = new Question();
        $question->fill([
            'name' => 'How old are you?',
            'type' => 'inline',
            'min_length' => 0,
            'max_length' => 100,
        ]);
        $question->recruitment()->associate(1);
        $question->save();

        //(#2) Multiline question for recruitment 1 (Media Team): "Describe yourself".
        $question = new Question();
        $question->fill([
            'name' => 'Describe yourself',
            'type' => 'multiline',
            'min_length' => 200,
            'max_length' => 5000,
        ]);
        $question->recruitment()->associate(1);
        $question->save();

        //(#3) Inline question for recruitment 2 (Convoy Control Team): "How old are you?".
        $question = new Question();
        $question->fill([
            'name' => 'How old are you?',
            'type' => 'inline',
            'min_length' => 0,
            'max_length' => 100,
        ]);
        $question->recruitment()->associate(2);
        $question->save();

        //(#4) Multiline question for recruitment 2 (Convoy Control Team): "Describe yourself".
        $question = new Question();
        $question->fill([
            'name' => 'Describe yourself',
            'type' => 'multiline',
            'min_length' => 200,
            'max_length' => 5000,
        ]);
        $question->recruitment()->associate(2);
        $question->save();

        //(#5) Inline question for recruitment 2 (Convoy Control Team): "How much time can you devote per week for OCSC Event?".
        $question = new Question();
        $question->fill([
            'name' => 'How much time can you devote per week for OCSC Event?',
            'type' => 'inline',
            'min_length' => 0,
            'max_length' => 100,
        ]);
        $question->recruitment()->associate(2);
        $question->save();

        //(#6) Inline question for recruitment 3 (Translation Team): "Which languages do you know very well?".
        $question = new Question();
        $question->fill([
            'name' => 'Which languages do you know very well?',
            'type' => 'inline',
            'min_length' => 0,
            'max_length' => 200,
        ]);
        $question->recruitment()->associate(2);
        $question->save();
    }
}
