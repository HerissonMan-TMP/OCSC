<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group = Group::create([
            'name' => 'Administrators',
        ]);

        $group = Group::create([
            'name' => 'Managers',
        ]);

        $group = Group::create([
            'name' => 'Staff',
        ]);
    }
}
