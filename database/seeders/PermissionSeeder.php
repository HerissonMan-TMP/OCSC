<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
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
        Artisan::call('permissions:generate');

        $adminPermission = Permission::where('slug', 'has-admin-rights')->first();

        Role::where('name', 'Chief Executive Officer')->first()->permissions()->attach($adminPermission);
    }
}
