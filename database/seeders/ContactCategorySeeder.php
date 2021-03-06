<?php

namespace Database\Seeders;

use App\Models\ContactCategory;
use Illuminate\Database\Seeder;

class ContactCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContactCategory::create([
            'name' => 'Question'
        ]);
        ContactCategory::create([
            'name' => 'I want OCSC to supervise my convoy'
        ]);
        ContactCategory::create([
            'name' => 'Report a Bug (Website / Discord)'
        ]);
        ContactCategory::create([
            'name' => 'Report a Staff member'
        ]);
    }
}
