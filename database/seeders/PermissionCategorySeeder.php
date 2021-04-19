<?php

namespace Database\Seeders;

use App\Models\PermissionCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission_categories')->truncate();

        //(#1) "Administration" category.
        PermissionCategory::create([
            'name' => 'Administration'
        ]);

        //(#2) "Convoys" category.
        PermissionCategory::create([
            'name' => 'Convoys'
        ]);

        //(#3) "News Articles" category.
        PermissionCategory::create([
            'name' => 'News Articles'
        ]);

        //(#4) "Partnership" category.
        PermissionCategory::create([
            'name' => 'Partnership'
        ]);

        //(#5) "Gallery" category.
        PermissionCategory::create([
            'name' => 'Gallery'
        ]);

        //(#6) "Downloads" category.
        PermissionCategory::create([
            'name' => 'Downloads'
        ]);

        //(#7) "Contact Messages" category.
        PermissionCategory::create([
            'name' => 'Contact Messages'
        ]);

        //(#8) "Subscribers" category.
        PermissionCategory::create([
            'name' => 'Subscribers'
        ]);

        //(#9) "Recruitments" category.
        PermissionCategory::create([
            'name' => 'Recruitments'
        ]);

        //(#10) "Staff Members" category.
        PermissionCategory::create([
            'name' => 'Staff Members'
        ]);

        //(#11) "Roles & Permissions" category.
        PermissionCategory::create([
            'name' => 'Roles & Permissions'
        ]);

        //(#12) "Website Settings" category.
        PermissionCategory::create([
            'name' => 'Website Settings'
        ]);

        //(#13) "Other" category.
        PermissionCategory::create([
            'name' => 'Other'
        ]);
    }
}
