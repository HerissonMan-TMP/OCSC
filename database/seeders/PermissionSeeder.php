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
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('permission_role')->truncate();
        DB::table('permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $permission1 = new Permission;
        $permission1->name = 'Has Admin rights';
        $permission1->slug = 'has-admin-rights';
        $permission1->save();
        $permission1->roles()->attach(6);

        $permission2 = new Permission;
        $permission2->name = 'Manage recruitments';
        $permission2->slug = 'manage-recruitments';
        $permission2->save();
        $permission2->roles()->attach([5, 6]);

        $permission3 = new Permission;
        $permission3->name = 'See Staff members list';
        $permission3->slug = 'see-staff-members-list';
        $permission3->save();
        $permission3->roles()->attach([1, 2, 3, 4, 5, 6]);

        $permission4 = new Permission;
        $permission4->name = 'See new Staff members\' temporary password';
        $permission4->slug = 'see-temporary-password-of-new-staff-members';
        $permission4->save();
        $permission4->roles()->attach([5, 6]);

        $permission5 = new Permission;
        $permission5->name = 'Assign Roles';
        $permission5->slug = 'assign-roles';
        $permission5->save();
        $permission5->roles()->attach([5, 6]);
    }
}
