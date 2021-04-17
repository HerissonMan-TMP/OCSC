<?php

namespace Database\Seeders;

use App\Models\ActivityType;
use Illuminate\Database\Seeder;

class ActivityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ActivityType::create([
            'name' => 'created',
            'icon' => 'fas fa-plus-circle',
            'color' => 'bg-green-500',
        ]);

        ActivityType::create([
            'name' => 'updated',
            'icon' => 'fas fa-edit',
            'color' => 'bg-yellow-500',
        ]);

        ActivityType::create([
            'name' => 'deleted',
            'icon' => 'fas fa-trash-alt',
            'color' => 'bg-red-500',
        ]);

        ActivityType::create([
            'name' => 'logged in',
            'icon' => 'fas fa-sign-in-alt',
            'color' => 'bg-blue-500',
        ]);

        ActivityType::create([
            'name' => 'logged out',
            'icon' => 'fas fa-sign-out-alt',
            'color' => 'bg-blue-500',
        ]);

        ActivityType::create([
            'name' => 'subscribed',
            'icon' => 'fas fa-paper-plane',
            'color' => 'bg-blue-500',
        ]);

        ActivityType::create([
            'name' => 'unsubscribed',
            'icon' => 'fas fa-paper-plane',
            'color' => 'bg-blue-500',
        ]);

        ActivityType::create([
            'name' => 'applied for',
            'icon' => 'fas fa-briefcase',
            'color' => 'bg-blue-500',
        ]);

        ActivityType::create([
            'name' => 'application accepted',
            'icon' => 'fas fa-check-circle',
            'color' => 'bg-green-500',
        ]);

        ActivityType::create([
            'name' => 'application declined',
            'icon' => 'fas fa-times-circle',
            'color' => 'bg-red-500',
        ]);

        ActivityType::create([
            'name' => 'marked as read',
            'icon' => 'fas fa-envelope-open',
            'color' => 'bg-blue-500',
        ]);

        ActivityType::create([
            'name' => 'marked as unread',
            'icon' => 'fas fa-envelope',
            'color' => 'bg-blue-500',
        ]);

        ActivityType::create([
            'name' => 'enabled',
            'icon' => 'fas fa-toggle-on',
            'color' => 'bg-green-700',
        ]);

        ActivityType::create([
            'name' => 'disabled',
            'icon' => 'fas fa-toggle-off',
            'color' => 'bg-red-700',
        ]);
    }
}
