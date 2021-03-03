<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create([
            'name' => 'Convoy Control Team',
            'icon_name' => 'car',
            'description' => 'In charge of supervising convoys and participating VTCs.',
            'color' => '#fcba03',
            'recruitment_enabled' => true
        ]);
        $role1->permissions()->attach(2);
        $role1->users()->attach([1, 2]);

        $role2 = Role::create([
            'name' => 'Event Team',
            'icon_name' => 'map',
            'description' => 'In charge of creating future convoy routes / events.',
            'color' => '#3458eb',
            'recruitment_enabled' => true
        ]);
        $role2->permissions()->attach(2);
        $role2->users()->attach([3, 4]);

        $role3 = Role::create([
            'name' => 'Media Team',
            'icon_name' => 'camera',
            'description' => 'In charge of taking photos and videos during our convoys and events.',
            'color' => '#770bbf',
            'recruitment_enabled' => true
        ]);
        $role3->permissions()->attach(2);
        $role3->users()->attach([5, 6]);

        $role4 = Role::create([
            'name' => 'Translation Team',
            'icon_name' => 'language',
            'description' => 'In charge of translating official content (news post, convoy information, ...).',
            'color' => '#ff9cd6',
            'recruitment_enabled' => true
        ]);
        $role4->permissions()->attach(2);
        $role4->users()->attach([7, 8]);

        $role5 = Role::create([
            'name' => 'Chief Operating Officer',
            'icon_name' => 'user-tie',
            'description' => 'Help the CEO in taking decisions and manage the whole team.',
            'color' => '#04d992',
            'recruitment_enabled' => false
        ]);
        $role5->permissions()->attach(1);
        $role5->users()->attach(9);

        $role6 = Role::create([
            'name' => 'Chief Executive Officer',
            'icon_name' => 'user-tie',
            'description' => 'Take decisions for the future of OCSC Event.',
            'color' => '#00b579',
            'recruitment_enabled' => false
        ]);
        $role6->permissions()->attach(1);
        $role6->users()->attach(10);
    }
}
