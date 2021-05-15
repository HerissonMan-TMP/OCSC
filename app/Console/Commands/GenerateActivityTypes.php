<?php

namespace App\Console\Commands;

use App\Models\ActivityType;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GenerateActivityTypes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'activity-types:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store the default activity types for production in the database.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $continue = true;

        if (ActivityType::exists()) {
            $continue = $this->confirm('The activity types table is not empty. By continuing, the current data will be deleted and replaced by new ones. Do you want to continue?');
        }

        if ($continue) {
            DB::table('activity_types')->delete();

            //Type: "Created".
            ActivityType::create([
                'name' => 'created',
                'icon' => 'fas fa-plus-circle',
                'color' => 'bg-green-500',
            ]);

            //Type: "Updated".
            ActivityType::create([
                'name' => 'updated',
                'icon' => 'fas fa-edit',
                'color' => 'bg-yellow-500',
            ]);

            //Type: "Deleted".
            ActivityType::create([
                'name' => 'deleted',
                'icon' => 'fas fa-trash-alt',
                'color' => 'bg-red-500',
            ]);

            //Type: "Logged In".
            ActivityType::create([
                'name' => 'logged in',
                'icon' => 'fas fa-sign-in-alt',
                'color' => 'bg-blue-500',
            ]);

            //Type: "Logged Out".
            ActivityType::create([
                'name' => 'logged out',
                'icon' => 'fas fa-sign-out-alt',
                'color' => 'bg-blue-500',
            ]);

            //Type: "Applied For".
            ActivityType::create([
                'name' => 'applied for',
                'icon' => 'fas fa-briefcase',
                'color' => 'bg-blue-500',
            ]);

            //Type: "Application Accepted".
            ActivityType::create([
                'name' => 'application accepted',
                'icon' => 'fas fa-check-circle',
                'color' => 'bg-green-500',
            ]);

            //Type: "Application Declined".
            ActivityType::create([
                'name' => 'application declined',
                'icon' => 'fas fa-times-circle',
                'color' => 'bg-red-500',
            ]);

            //Type: "Marked As Read".
            ActivityType::create([
                'name' => 'marked as read',
                'icon' => 'fas fa-envelope-open',
                'color' => 'bg-blue-500',
            ]);

            //Type: "Marked As Unread".
            ActivityType::create([
                'name' => 'marked as unread',
                'icon' => 'fas fa-envelope',
                'color' => 'bg-blue-500',
            ]);

            //Type: "Enabled".
            ActivityType::create([
                'name' => 'enabled',
                'icon' => 'fas fa-toggle-on',
                'color' => 'bg-green-700',
            ]);

            //Type: "Disabled".
            ActivityType::create([
                'name' => 'disabled',
                'icon' => 'fas fa-toggle-off',
                'color' => 'bg-red-700',
            ]);

            $this->info('The activity types have been successfully stored!');
        }

        return 0;
    }
}
