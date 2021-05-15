<?php

namespace App\Console\Commands;

use App\Models\Permission;
use App\Models\PermissionCategory;
use Illuminate\Console\Command;

class GeneratePermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permissions:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store the default permissions for production in the database.';

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

        if (!PermissionCategory::exists()) {
            $this->error('You must add data in the permission categories table before.');
        }

        if (Permission::exists()) {
            $continue = $this->confirm('The permissions table is not empty. By continuing, the current data will be deleted and replaced by new ones. Do you want to continue?');
        }

        if ($continue) {
            //Has Admin Rights.
            Permission::create([
                'name' => 'Has Admin rights',
                'slug' => 'has-admin-rights',
                'category_id' => PermissionCategory::where('name', 'Administration')->first()->id,
            ]);

            //Manage convoys.
            Permission::create([
                'name' => 'Manage convoys',
                'slug' => 'manage-convoys',
                'category_id' => PermissionCategory::where('name', 'Convoys')->first()->id,
            ]);

            //Edit convoy rules.
            Permission::create([
                'name' => 'Edit convoy rules',
                'slug' => 'edit-convoy-rules',
                'category_id' => PermissionCategory::where('name', 'Convoys')->first()->id,
            ]);

            //Manage News Articles.
            Permission::create([
                'name' => 'Manage News Articles',
                'slug' => 'manage-news-articles',
                'category_id' => PermissionCategory::where('name', 'News Articles')->first()->id,
            ]);

            //Manage Partners.
            Permission::create([
                'name' => 'Manage partners',
                'slug' => 'manage-partners',
                'category_id' => PermissionCategory::where('name', 'Partnership')->first()->id,
            ]);

            //Edit partnership conditions & information.
            Permission::create([
                'name' => 'Edit partnership conditions & information',
                'slug' => 'edit-partnership-conditions-and-info',
                'category_id' => PermissionCategory::where('name', 'Partnership')->first()->id,
            ]);

            //Manage partner categories.
            Permission::create([
                'name' => 'Manage partner categories',
                'slug' => 'manage-partner-categories',
                'category_id' => PermissionCategory::where('name', 'Partnership')->first()->id,
            ]);

            //Manage the pictures.
            Permission::create([
                'name' => 'Manage pictures',
                'slug' => 'manage-pictures',
                'category_id' => PermissionCategory::where('name', 'Gallery')->first()->id,
            ]);

            //Add pictures to the gallery (with the ability to manage them).
            Permission::create([
                'name' => 'Add pictures to the gallery (with the ability to manage them)',
                'slug' => 'add-pictures-to-gallery',
                'category_id' => PermissionCategory::where('name', 'Gallery')->first()->id,
            ]);

            //Manage Downloads.
            Permission::create([
                'name' => 'Manage Downloads',
                'slug' => 'manage-downloads',
                'category_id' => PermissionCategory::where('name', 'Downloads')->first()->id,
            ]);

            //Manage contact messages.
            Permission::create([
                'name' => 'Manage contact messages',
                'slug' => 'manage-contact-messages',
                'category_id' => PermissionCategory::where('name', 'Contact Messages')->first()->id,
            ]);

            //Manage recruitments.
            Permission::create([
                'name' => 'Manage recruitments',
                'slug' => 'manage-recruitments',
                'category_id' => PermissionCategory::where('name', 'Recruitments')->first()->id,
            ]);

            //Edit global requirements.
            Permission::create([
                'name' => 'Edit global requirements',
                'slug' => 'edit-global-requirements',
                'category_id' => PermissionCategory::where('name', 'Recruitments')->first()->id,
            ]);

            //See Staff members' email address.
            $permission = Permission::create([
                'name' => 'See Staff members\' email address',
                'slug' => 'see-email-address-of-staff-members',
                'category_id' => PermissionCategory::where('name', 'Staff Members')->first()->id,
            ]);

            //See new Staff members' temporary password.
            $permission = Permission::create([
                'name' => 'See new Staff members\' temporary password',
                'slug' => 'see-temporary-password-of-new-staff-members',
                'category_id' => PermissionCategory::where('name', 'Staff Members')->first()->id,
            ]);

            //See activity.
            $permission = Permission::create([
                'name' => 'See activity',
                'slug' => 'see-activity',
                'category_id' => PermissionCategory::where('name', 'Website Settings')->first()->id,
            ]);

            //Edit legal notice.
            $permission = Permission::create([
                'name' => 'Edit legal notice',
                'slug' => 'edit-legal-notice',
                'category_id' => PermissionCategory::where('name', 'Website Settings')->first()->id,
            ]);

            //Edit privacy policy.
            $permission = Permission::create([
                'name' => 'Edit privacy policy',
                'slug' => 'edit-privacy-policy',
                'category_id' => PermissionCategory::where('name', 'Website Settings')->first()->id,
            ]);

            //See statistics.
            $permission = Permission::create([
                'name' => 'See statistics',
                'slug' => 'see-statistics',
                'category_id' => PermissionCategory::where('name', 'Website Settings')->first()->id,
            ]);

            //See error logs.
            $permission = Permission::create([
                'name' => 'See error logs',
                'slug' => 'see-error-logs',
                'category_id' => PermissionCategory::where('name', 'Website Settings')->first()->id,
            ]);

            //Toggle maintenance mode.
            $permission = Permission::create([
                'name' => 'Toggle maintenance mode',
                'slug' => 'toggle-maintenance-mode',
                'category_id' => PermissionCategory::where('name', 'Website Settings')->first()->id,
            ]);

            //Manage guides.
            $permission = Permission::create([
                'name' => 'Manage guides',
                'slug' => 'manage-guides',
                'category_id' => PermissionCategory::where('name', 'Guides')->first()->id,
            ]);

            $this->info('The permissions have been successfully stored!');
        }

        return 0;
    }
}
