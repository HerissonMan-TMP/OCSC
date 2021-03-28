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
        //Contact Category: Question
        ContactCategory::create([
            'name' => 'Question'
        ]);

        //Contact Category: I want OCSC to supervise my convoy
        ContactCategory::create([
            'name' => 'I want OCSC to supervise my convoy'
        ]);

        //Contact Category: Report a Bug (Website / Discord)
        ContactCategory::create([
            'name' => 'Report a Bug (Website / Discord)'
        ]);

        //Contact Category: Report a Staff member
        ContactCategory::create([
            'name' => 'Report a Staff member'
        ]);
    }
}
