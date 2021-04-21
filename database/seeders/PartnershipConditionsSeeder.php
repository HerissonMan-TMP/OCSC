<?php

namespace Database\Seeders;

use App\Models\PartnershipConditions;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartnershipConditionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('partnership_conditions')->truncate();

        PartnershipConditions::create([
            'content' => 'The partnership conditions with **markdown**.',
        ]);
    }
}
