<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $question = new Question;
        $question->fill([
            'name' => 'How old are you?',
            'type' => 'inline',
            'min_length' => 0,
            'max_length' => 100,
        ]);
        $question->recruitment()->associate(1);
        $question->save();

        $question = new Question;
        $question->fill([
            'name' => 'Describe yourself',
            'type' => 'multiline',
            'min_length' => 200,
            'max_length' => 5000,
        ]);
        $question->recruitment()->associate(1);
        $question->save();

        $question = new Question;
        $question->fill([
            'name' => 'Which languages very well?',
            'type' => 'inline',
            'min_length' => 0,
            'max_length' => 200,
        ]);
        $question->recruitment()->associate(2);
        $question->save();
    }
}
