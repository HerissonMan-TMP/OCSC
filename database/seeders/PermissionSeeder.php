<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permission: Has Admin Rights
        $permission = Permission::create([
           'name' => 'Has Admin rights',
           'slug' => 'has-admin-rights',
        ]);
        $permission->save();
        $permission->roles()->attach([1, 2, 3]);

        //Permission: Manage recruitments
        $permission = Permission::create([
            'name' => 'Manage recruitments',
            'slug' => 'manage-recruitments',
        ]);
        $permission->save();
        $permission->roles()->attach(4);

        //Permission: See Staff members list
        $permission = Permission::create([
            'name' => 'See Staff members list',
            'slug' => 'see-staff-members-list',
        ]);
        $permission->save();
        $permission->roles()->attach([4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16]);

        //Permission: See new Staff members' temporary password
        $permission = Permission::create([
            'name' => 'See new Staff members\' temporary password',
            'slug' => 'see-temporary-password-of-new-staff-members',
        ]);
        $permission->save();
        $permission->roles()->attach([4, 5, 6, 7, 8]);

        //Permission: Update permissions (only for roles with a group level below)
        $permission = Permission::create([
           'name' => 'Update permissions (only for roles with a role group level below)',
           'slug' => 'update-permissions'
        ]);
        $permission->save();

        //Permission: Assign roles (only to users with a role group level below)
        $permission = Permission::create([
            'name' => 'Assign roles (only to users with a role group level below)',
            'slug' => 'assign-roles',
        ]);
        $permission->save();
        $permission->roles()->attach(4);

        //Permission: Create new users
        $permission = Permission::create([
            'name' => 'Create new users',
            'slug' => 'create-new-users'
        ]);
        $permission->save();
        $permission->roles()->attach(4);

        //Permission: Read contact messages
        $permission = Permission::create([
            'name' => 'Read contact messages',
            'slug' => 'read-contact-messages'
        ]);
        $permission->save();
        $permission->roles()->attach([4, 5, 6, 7, 8]);

        //Permission: Change contact messages status
        $permission = Permission::create([
            'name' => 'Change contact messages status',
            'slug' => 'change-contact-messages-status'
        ]);
        $permission->save();
        $permission->roles()->attach([4, 5, 6, 7, 8]);

        //Permission: Delete contact messages
        $permission = Permission::create([
            'name' => 'Delete contact messages',
            'slug' => 'delete-contact-messages'
        ]);
        $permission->save();

        //Permission: Manage convoys
        $permission = Permission::create([
            'name' => 'Manage convoys',
            'slug' => 'manage-convoys'
        ]);
        $permission->save();
        $permission->roles()->attach([4, 5]);

        //Permission: See Downloads
        $permission = Permission::create([
            'name' => 'See Downloads',
            'slug' => 'see-downloads'
        ]);
        $permission->save();
        $permission->roles()->attach([4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16]);

        //Permission: Manage Downloads
        $permission = Permission::create([
            'name' => 'Manage Downloads',
            'slug' => 'manage-downloads'
        ]);
        $permission->save();
        $permission->roles()->attach(4);

        //Permission: Manage News Articles
        $permission = Permission::create([
            'name' => 'Manage News Articles',
            'slug' => 'manage-news-article'
        ]);
        $permission->save();
        $permission->roles()->attach(4);
    }
}
