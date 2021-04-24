<?php

namespace Database\Seeders;

use App\Models\Recruitment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecruitmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('recruitments')->truncate();

        //(#1) Planned recruitment for Media Team.
        $recruitment = new Recruitment();
        $recruitment->fill([
            'start_at' => now()->addDays(20),
            'end_at' => now()->addDays(40)
        ]);
        $recruitment->role()->associate(15);
        $recruitment->user()->associate(4);
        $recruitment->save();

        //(#2) Open recruitment for Convoy Control Team.
        $recruitment = new Recruitment();
        $recruitment->fill([
            'start_at' => now(),
            'end_at' => now()->addDays(15),
            'specific_requirements' => '- test requirement 1'
        ]);
        $recruitment->role()->associate(10);
        $recruitment->user()->associate(1);
        $recruitment->save();

        //(#3) Open recruitment for Translation Team.
        $recruitment = new Recruitment();
        $recruitment->fill([
            'start_at' => now(),
            'end_at' => now()->addDays(18),
            'note' => 'Good luck!'
        ]);
        $recruitment->role()->associate(14);
        $recruitment->user()->associate(4);
        $recruitment->save();

        //(#4) Closed recruitment for Event Team.
        $recruitment = new Recruitment();
        $recruitment->fill([
            'start_at' => now()->subDays(40),
            'end_at' => now()->subDays(20)
        ]);
        $recruitment->role()->associate(12);
        $recruitment->user()->associate(2);
        $recruitment->save();
    }
}
