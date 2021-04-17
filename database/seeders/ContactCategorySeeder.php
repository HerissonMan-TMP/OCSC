<?php

namespace Database\Seeders;

use App\Models\ContactCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contact_categories')->truncate();

        //(#1) Contact Category: "Question".
        ContactCategory::create([
            'name' => 'Question'
        ]);

        //(#2) Contact Category: "I want OCSC to supervise my convoy".
        ContactCategory::create([
            'name' => 'I want OCSC to supervise my convoy'
        ]);

        //(#3) Contact Category: "Report a Bug (Website / Discord)".
        ContactCategory::create([
            'name' => 'Report a Bug (Website / Discord)'
        ]);

        //(#4) Contact Category: "Report a Staff member".
        ContactCategory::create([
            'name' => 'Report a Staff member'
        ]);

        //(#5) Contact Category: "Privacy / Personal data".
        ContactCategory::create([
            'name' => 'Privacy / Personal data'
        ]);
    }
}
