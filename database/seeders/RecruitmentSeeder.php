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
        $recruitment1 = new Recruitment;
        $recruitment1->start_at = now();
        $recruitment1->end_at = now()->addDays(15);
        $recruitment1->role()->associate(1);
        $recruitment1->user()->associate(10);
        $recruitment1->save();

        $recruitment2 = new Recruitment;
        $recruitment2->start_at = now();
        $recruitment2->end_at = now()->addDays(15);
        $recruitment2->role()->associate(4);
        $recruitment2->user()->associate(9);
        $recruitment2->save();

        $recruitment3 = new Recruitment;
        $recruitment3->start_at = now();
        $recruitment3->end_at = now()->addDays(20);
        $recruitment3->role()->associate(3);
        $recruitment3->user()->associate(9);
        $recruitment3->save();

        $recruitment4 = new Recruitment;
        $recruitment4->start_at = now()->subDays(40);
        $recruitment4->end_at = now()->subDays(20);
        $recruitment4->role()->associate(2);
        $recruitment4->user()->associate(9);
        $recruitment4->save();
    }
}
