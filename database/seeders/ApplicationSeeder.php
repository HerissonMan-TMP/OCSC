<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Recruitment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('applications')->truncate();

        //8 applications for Convoy Control Team recruitment: 3 new, 1 accepted, 4 declined.
        $recruitment = Recruitment::find(2);
        Application::factory(3)
                    ->for($recruitment)
                    ->create();
        Application::factory(1)
            ->for($recruitment)
            ->accepted()
            ->create();
        Application::factory(4)
            ->for($recruitment)
            ->declined()
            ->create();

        //3 applications for Translation Team recruitment: 3 new.
        $recruitment = Recruitment::find(3);
        Application::factory(3)
            ->for($recruitment)
            ->create();

        //4 applications for Event Team recruitment: 2 new, 2 declined.
        $recruitment = Recruitment::find(4);
        Application::factory(2)
            ->for($recruitment)
            ->create();
        Application::factory(2)
            ->for($recruitment)
            ->declined()
            ->create();
    }
}
