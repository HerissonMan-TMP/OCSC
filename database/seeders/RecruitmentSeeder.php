<?php

namespace Database\Seeders;

use App\Models\Recruitment;
use Illuminate\Database\Seeder;

class RecruitmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $recruitment = new Recruitment;
        $recruitment->fill([
            'start_at' => now(),
            'end_at' => now()->addDays(15),
            'specific_requirements' => '- test requirement 1'
        ]);
        $recruitment->role()->associate(1);
        $recruitment->user()->associate(10);
        $recruitment->save();

        $recruitment = new Recruitment;
        $recruitment->fill([
            'start_at' => now(),
            'end_at' => now()->addDays(15),
            'note' => 'Good luck!'
        ]);
        $recruitment->role()->associate(4);
        $recruitment->user()->associate(9);
        $recruitment->save();

        $recruitment = new Recruitment;
        $recruitment->fill([
            'start_at' => now(),
            'end_at' => now()->addDays(20)
        ]);
        $recruitment->role()->associate(3);
        $recruitment->user()->associate(9);
        $recruitment->save();

        $recruitment = new Recruitment;
        $recruitment->fill([
            'start_at' => now()->subDays(40),
            'end_at' => now()->subDays(20)
        ]);
        $recruitment->role()->associate(2);
        $recruitment->user()->associate(9);
        $recruitment->save();
    }
}
