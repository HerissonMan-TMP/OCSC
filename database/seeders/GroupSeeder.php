<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->truncate();

        //(#1) Administrators group.
        $group = Group::create([
            'name' => 'Administrators'
        ]);

        //(#2) Managers group.
        $group = Group::create([
            'name' => 'Managers'
        ]);

        //(#3) Staff group.
        $group = Group::create([
            'name' => 'Staff'
        ]);
    }
}
