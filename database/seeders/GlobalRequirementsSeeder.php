<?php

namespace Database\Seeders;

use App\Models\GlobalRequirements;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GlobalRequirementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('global_requirements')->truncate();

        GlobalRequirements::create([
            'content' => 'This is the global requirements with **markdown** __support__.'
        ]);
    }
}
