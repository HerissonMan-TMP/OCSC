<?php

namespace Database\Seeders;

use App\Models\Application;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //New application for Convoy Control Team
        $application = new Application;
        $application->fill([
            'discord' => 'Blabla#5211',
            'email' => 'blable@blabla.com'
        ]);
        $application->recruitment()->associate(1);
        $application->save();

        //Declined application for Convoy Control Team
        $application = new Application;
        $application->fill([
            'discord' => 'StrongMan#2222',
            'email' => 'strongman@strongemail.com',
            'status' => 'declined'
        ]);
        $application->recruitment()->associate(1);
        $application->save();

        //Accepted application for Convoy Control Team
        $application = new Application;
        $application->fill([
            'discord' => 'Test#3333',
            'email' => 'test@test.com',
            'status' => 'accepted'
        ]);
        $application->recruitment()->associate(1);
        $application->save();

        //New application for Translation Team
        $application = new Application;
        $application->fill([
            'discord' => 'Heya#1101',
            'email' => 'heya@email.com'
        ]);
        $application->recruitment()->associate(2);
        $application->save();

        //Declined application for Translation Team
        $application = new Application;
        $application->fill([
            'discord' => 'Laravel#2222',
            'email' => 'laravel@php.com',
            'status' => 'declined'
        ]);
        $application->recruitment()->associate(2);
        $application->save();
    }
}
