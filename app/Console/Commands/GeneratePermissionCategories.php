<?php

namespace App\Console\Commands;

use App\Models\PermissionCategory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GeneratePermissionCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission-categories:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store the default permission categories for production in the database.';

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

        if (PermissionCategory::exists()) {
            $continue = $this->confirm('The permission categories table is not empty. By continuing, the current data will be deleted and replaced by new ones. Do you want to continue?');
        }

        if ($continue) {
            DB::table('permission_categories')->delete();

            //Administration.
            PermissionCategory::create([
                'name' => 'Administration',
            ]);

            //Convoys.
            PermissionCategory::create([
                'name' => 'Convoys',
            ]);

            //News Articles.
            PermissionCategory::create([
                'name' => 'News Articles',
            ]);

            //Partnership.
            PermissionCategory::create([
                'name' => 'Partnership',
            ]);

            //Gallery.
            PermissionCategory::create([
                'name' => 'Gallery',
            ]);

            //Downloads.
            PermissionCategory::create([
                'name' => 'Downloads',
            ]);

            //Contact Messages.
            PermissionCategory::create([
                'name' => 'Contact Messages',
            ]);

            //Recruitments.
            PermissionCategory::create([
                'name' => 'Recruitments',
            ]);

            //Staff Members.
            PermissionCategory::create([
                'name' => 'Staff Members',
            ]);

            //(Roles & Permissions.
            PermissionCategory::create([
                'name' => 'Roles & Permissions',
            ]);

            //(Website Settings.
            PermissionCategory::create([
                'name' => 'Website Settings',
            ]);

            //(Other.
            PermissionCategory::create([
                'name' => 'Other',
            ]);

            //(Guides.
            PermissionCategory::create([
                'name' => 'Guides',
            ]);

            $this->info('The permission categories have been successfully stored!');
        }

        return 0;
    }
}
