<?php

namespace Database\Seeders;

use App\Models\PartnerCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartnerCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('partner_categories')->truncate();

        PartnerCategory::create([
            'name' => 'VTC Partnership',
            'description' => 'Description for the VTC partnership...',
            'opening_at' => now()->addDays(30),
        ]);

        PartnerCategory::create([
            'name' => 'Community Partnership',
            'description' => 'Description for the community partnership...',
            'opening_at' => null,
        ]);
    }
}
