<?php

namespace Database\Seeders;

use App\Models\Answer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('answers')->truncate();

        //(#1) Answer to "How old are you?" in Convoy Control Team application.
        $answer = new Answer();
        $answer->fill([
            'text' => '16',
        ]);
        $answer->application()->associate(1);
        $answer->question()->associate(1);
        $answer->save();

        //(#2) Answer to "Describe yourself" in Convoy Control Team application.
        $answer = new Answer();
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

        //(#3) Answer to "How old are you?" in Convoy Control Team application.
        $answer = new Answer();
        $answer->fill([
            'text' => 'I\'m 19',
        ]);
        $answer->application()->associate(5);
        $answer->question()->associate(3);
        $answer->save();

        //(#4) Answer to "Describe yourself" in Convoy Control Team application.
        $answer = new Answer();
        $answer->fill([
            'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                    nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit
                    esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                    culpa qui officia deserunt mollit anim id est laborum.',
        ]);
        $answer->application()->associate(5);
        $answer->question()->associate(4);
        $answer->save();

        //(#5) Answer to "Which languages do you know very well?" in Translation Team application.
        $answer = new Answer();
        $answer->fill([
            'text' => 'English, as well as German',
        ]);
        $answer->application()->associate(10);
        $answer->question()->associate(3);
        $answer->save();

        //(#6) Answer to "How much time can you devote per week for OCSC Event?" in Convoy Control Team application.
        $answer = new Answer();
        $answer->fill([
            'text' => '20 hours',
        ]);
        $answer->application()->associate(5);
        $answer->question()->associate(5);
        $answer->save();
    }
}
