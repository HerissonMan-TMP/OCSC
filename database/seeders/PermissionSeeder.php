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
        $permission = Permission::create([
           'name' => 'Has Admin rights',
           'slug' => 'has-admin-rights',
        ]);
        $permission->save();
        $permission->roles()->attach(6);

        $permission = Permission::create([
            'name' => 'Manage recruitments',
            'slug' => 'manage-recruitments',
        ]);
        $permission->save();
        $permission->roles()->attach([5, 6]);

        $permission = Permission::create([
            'name' => 'See Staff members list',
            'slug' => 'see-staff-members-list',
        ]);
        $permission->save();
        $permission->roles()->attach([1, 2, 3, 4, 5, 6]);

        $permission = Permission::create([
            'name' => 'See new Staff members\' temporary password',
            'slug' => 'see-temporary-password-of-new-staff-members',
        ]);
        $permission->save();
        $permission->roles()->attach([5, 6]);

        $permission = Permission::create([
           'name' => 'Update permissions (only for roles with a group level below)',
           'slug' => 'update-permissions'
        ]);
        $permission->save();
        $permission->roles()->attach([6]);

        $permission = Permission::create([
            'name' => 'Assign roles (only to users with a role group level below)',
            'slug' => 'assign-roles',
        ]);
        $permission->save();
        $permission->roles()->attach([5, 6]);

        $permission = Permission::create([
            'name' => 'Create new users',
            'slug' => 'create-new-users'
        ]);
        $permission->save();
        $permission->roles()->attach([5, 6]);
    }
}
