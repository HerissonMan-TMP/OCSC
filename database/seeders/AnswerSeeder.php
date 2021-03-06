<?php

namespace Database\Seeders;

use App\Models\Answer;
use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $answer = new Answer;
        $answer->fill([
            'text' => '16',
        ]);
        $answer->application()->associate(1);
        $answer->question()->associate(1);
        $answer->save();

        $answer = new Answer;
        $answer->fill([
            'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                    nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit
                    esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                    culpa qui officia deserunt mollit anim id est laborum.',
        ]);
        $answer->application()->associate(1);
        $answer->question()->associate(2);
        $answer->save();

        $answer = new Answer;
        $answer->fill([
            'text' => 'I\'m 19',
        ]);
        $answer->application()->associate(2);
        $answer->question()->associate(1);
        $answer->save();

        $answer = new Answer;
        $answer->fill([
            'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                    nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit
                    esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                    culpa qui officia deserunt mollit anim id est laborum.',
        ]);
        $answer->application()->associate(2);
        $answer->question()->associate(2);
        $answer->save();

        $answer = new Answer;
        $answer->fill([
            'text' => 'Yes, as well as German',
        ]);
        $answer->application()->associate(3);
        $answer->question()->associate(3);
        $answer->save();

        $answer = new Answer;
        $answer->fill([
            'text' => 'A little bit, not very well',
        ]);
        $answer->application()->associate(4);
        $answer->question()->associate(3);
        $answer->save();
    }
}
