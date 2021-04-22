<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->truncate();
        DB::table('permission_role')->truncate();

        //Permission: Has Admin Rights.
        $permission = Permission::create([
           'name' => 'Has Admin rights',
           'slug' => 'has-admin-rights',
        ]);
        $permission->category()->associate(1);
        $permission->save();
        $permission->roles()->attach([1, 2, 3]);

        //Permission: Manage convoys.
        $permission = Permission::create([
            'name' => 'Manage convoys',
            'slug' => 'manage-convoys'
        ]);
        $permission->category()->associate(2);
        $permission->save();
        $permission->roles()->attach([4, 5]);

        //Permission: Edit convoy rules.
        $permission = Permission::create([
            'name' => 'Edit convoy rules',
            'slug' => 'edit-convoy-rules'
        ]);
        $permission->category()->associate(2);
        $permission->save();
        $permission->roles()->attach(5);

        //Permission: Manage News Articles.
        $permission = Permission::create([
            'name' => 'Manage News Articles',
            'slug' => 'manage-news-articles'
        ]);
        $permission->category()->associate(3);
        $permission->save();
        $permission->roles()->attach(4);

        //Permission: Manage Partners.
        $permission = Permission::create([
             'name' => 'Manage partners',
             'slug' => 'manage-partners'
         ]);
        $permission->category()->associate(4);
        $permission->save();
        $permission->roles()->attach(4);

        //Permission: Edit partnership conditions & information.
        $permission = Permission::create([
            'name' => 'Edit partnership conditions & information',
            'slug' => 'edit-partnership-conditions-and-info'
        ]);
        $permission->category()->associate(4);
        $permission->save();
        $permission->roles()->attach(4);

        //Permission: Manage partner categories.
        $permission = Permission::create([
         'name' => 'Manage partner categories',
         'slug' => 'manage-partner-categories'
     ]);
        $permission->category()->associate(4);
        $permission->save();

        //Permission: Manage the pictures.
        $permission = Permission::create([
            'name' => 'Manage pictures',
            'slug' => 'manage-pictures'
        ]);
        $permission->category()->associate(5);
        $permission->save();

        //Permission: Add pictures to the gallery (with the ability to manage them).
        $permission = Permission::create([
            'name' => 'Add pictures to the gallery (with the ability to manage them)',
            'slug' => 'add-pictures-to-gallery'
        ]);
        $permission->category()->associate(5);
        $permission->save();
        $permission->roles()->attach([4, 5, 6, 7, 8, 15]);

        //Permission: Manage Downloads.
        $permission = Permission::create([
            'name' => 'Manage Downloads',
            'slug' => 'manage-downloads'
        ]);
        $permission->category()->associate(6);
        $permission->save();
        $permission->roles()->attach(4);

        //Permission: Manage contact messages.
        $permission = Permission::create([
            'name' => 'Manage contact messages',
            'slug' => 'manage-contact-messages'
        ]);
        $permission->category()->associate(7);
        $permission->save();
        $permission->roles()->attach([4, 5, 6, 7, 8]);

        //Permission: Manage recruitments.
        $permission = Permission::create([
            'name' => 'Manage recruitments',
            'slug' => 'manage-recruitments',
        ]);
        $permission->category()->associate(9);
        $permission->save();
        $permission->roles()->attach(4);

        //Permission: Edit global requirements.
        $permission = Permission::create([
            'name' => 'Edit global requirements',
            'slug' => 'edit-global-requirements',
        ]);
        $permission->category()->associate(9);
        $permission->save();
        $permission->roles()->attach(4);

        //Permission: See Staff members' email address.
        $permission = Permission::create([
            'name' => 'See Staff members\' email address',
            'slug' => 'see-email-address-of-staff-members',
        ]);
        $permission->category()->associate(10);
        $permission->save();
        $permission->roles()->attach([4, 5, 6, 7, 8]);

        //Permission: See new Staff members' temporary password.
        $permission = Permission::create([
            'name' => 'See new Staff members\' temporary password',
            'slug' => 'see-temporary-password-of-new-staff-members',
        ]);
        $permission->category()->associate(10);
        $permission->save();
        $permission->roles()->attach([4, 5, 6, 7, 8]);

        //Permission: See activity.
        $permission = Permission::create([
            'name' => 'See activity',
            'slug' => 'see-activity'
        ]);
        $permission->category()->associate(12);
        $permission->save();

        //Permission: Edit legal notice.
        $permission = Permission::create([
            'name' => 'Edit legal notice',
            'slug' => 'edit-legal-notice'
        ]);
        $permission->category()->associate(12);
        $permission->save();

        //Permission: Edit privacy policy.
        $permission = Permission::create([
            'name' => 'Edit privacy policy',
            'slug' => 'edit-privacy-policy'
        ]);
        $permission->category()->associate(12);
        $permission->save();

        //Permission: See statistics.
        $permission = Permission::create([
            'name' => 'See statistics',
            'slug' => 'see-statistics'
        ]);
        $permission->category()->associate(12);
        $permission->save();

        //Permission: See error logs.
        $permission = Permission::create([
            'name' => 'See error logs',
            'slug' => 'see-error-logs'
        ]);
        $permission->category()->associate(12);
        $permission->save();

        //Permission: Toggle maintenance mode.
        $permission = Permission::create([
            'name' => 'Toggle maintenance mode',
            'slug' => 'toggle-maintenance-mode'
        ]);
        $permission->category()->associate(12);
        $permission->save();

        //Permission: Manage guides.
        $permission = Permission::create([
             'name' => 'Manage guides',
             'slug' => 'manage-guides'
         ]);
        $permission->category()->associate(14);
        $permission->save();
    }
}
