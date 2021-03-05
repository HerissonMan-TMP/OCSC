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
        $permission1 = new Permission;
        $permission1->name = 'Has Admin Rights';
        $permission1->slug = 'has-admin-rights';
        $permission1->save();
        $permission1->roles()->attach(6);

        $permission2 = new Permission;
        $permission2->name = 'Manage Recruitments';
        $permission2->slug = 'manage-recruitments';
        $permission2->save();
        $permission2->roles()->attach([5, 6]);
    }
}
