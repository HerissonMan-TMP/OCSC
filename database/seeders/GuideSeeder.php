<?php

namespace Database\Seeders;

use App\Models\Guide;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('guides')->truncate();
        DB::table('guide_role')->truncate();

        Guide::factory(5)
            ->hasAttached(Role::inRandomOrder()->take(2)->get())
            ->create();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
