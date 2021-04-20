<?php

namespace Database\Seeders;

use App\Models\ActivityType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('activity_types')->truncate();

        //(#1) Type: "Created".
        ActivityType::create([
            'name' => 'created',
            'icon' => 'fas fa-plus-circle',
            'color' => 'bg-green-500',
        ]);

        //(#2) Type: "Updated".
        ActivityType::create([
            'name' => 'updated',
            'icon' => 'fas fa-edit',
            'color' => 'bg-yellow-500',
        ]);

        //(#3) Type: "Deleted".
        ActivityType::create([
            'name' => 'deleted',
            'icon' => 'fas fa-trash-alt',
            'color' => 'bg-red-500',
        ]);

        //(#4) Type: "Logged In".
        ActivityType::create([
            'name' => 'logged in',
            'icon' => 'fas fa-sign-in-alt',
            'color' => 'bg-blue-500',
        ]);

        //(#5) Type: "Logged Out".
        ActivityType::create([
            'name' => 'logged out',
            'icon' => 'fas fa-sign-out-alt',
            'color' => 'bg-blue-500',
        ]);

        //(#6) Type: "Applied For".
        ActivityType::create([
            'name' => 'applied for',
            'icon' => 'fas fa-briefcase',
            'color' => 'bg-blue-500',
        ]);

        //(#7) Type: "Application Accepted".
        ActivityType::create([
            'name' => 'application accepted',
            'icon' => 'fas fa-check-circle',
            'color' => 'bg-green-500',
        ]);

        //(#8) Type: "Application Declined".
        ActivityType::create([
            'name' => 'application declined',
            'icon' => 'fas fa-times-circle',
            'color' => 'bg-red-500',
        ]);

        //(#9) Type: "Marked As Read".
        ActivityType::create([
            'name' => 'marked as read',
            'icon' => 'fas fa-envelope-open',
            'color' => 'bg-blue-500',
        ]);

        //(#10) Type: "Marked As Unread".
        ActivityType::create([
            'name' => 'marked as unread',
            'icon' => 'fas fa-envelope',
            'color' => 'bg-blue-500',
        ]);

        //(#11) Type: "Enabled".
        ActivityType::create([
            'name' => 'enabled',
            'icon' => 'fas fa-toggle-on',
            'color' => 'bg-green-700',
        ]);

        //(#12) Type: "Disabled".
        ActivityType::create([
            'name' => 'disabled',
            'icon' => 'fas fa-toggle-off',
            'color' => 'bg-red-700',
        ]);
    }
}
