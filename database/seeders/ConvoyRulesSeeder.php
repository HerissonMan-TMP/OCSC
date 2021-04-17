<?php

namespace Database\Seeders;

use App\Models\ConvoyRules;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConvoyRulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('convoy_rules')->truncate();

        ConvoyRules::create([
            'content' => 'This is the convoy rules with **markdown** __support__.'
        ]);
    }
}
