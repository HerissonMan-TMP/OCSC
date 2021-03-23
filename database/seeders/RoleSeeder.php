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
            'group_level' => 2,
            'order' => 3,
            'name' => 'Convoy Control Team',
            'icon_name' => 'car',
            'description' => 'In charge of supervising convoys and participating VTCs.',
            'color' => '#fcba03',
            'contrast_color' => '#8a6501',
            'recruitment_enabled' => true
        ]);
        $role1->users()->attach([1, 2]);

        $role2 = Role::create([
            'group_level' => 2,
            'order' => 5,
            'name' => 'Event Team',
            'icon_name' => 'map',
            'description' => 'In charge of creating future convoy routes / events.',
            'color' => '#3458eb',
            'contrast_color' => '#1a2d78',
            'recruitment_enabled' => true
        ]);
        $role2->users()->attach([3, 4]);

        $role3 = Role::create([
            'group_level' => 2,
            'order' => 6,
            'name' => 'Media Team',
            'icon_name' => 'camera',
            'description' => 'In charge of taking photos and videos during our convoys and events.',
            'color' => '#770bbf',
            'contrast_color' => '#30054d',
            'recruitment_enabled' => true
        ]);
        $role3->users()->attach([5, 6]);

        $role4 = Role::create([
            'group_level' => 2,
            'order' => 4,
            'name' => 'Translation Team',
            'icon_name' => 'language',
            'description' => 'In charge of translating official content (news post, convoy information, ...).',
            'color' => '#ff9cd6',
            'contrast_color' => '#8c5675',
            'recruitment_enabled' => true
        ]);
        $role4->users()->attach([7, 8]);

        $role5 = Role::create([
            'group_level' => 1,
            'order' => 2,
            'name' => 'Chief Operating Officer',
            'icon_name' => 'user-tie',
            'description' => 'Help the CEO in taking decisions and manage the whole team.',
            'color' => '#04d992',
            'contrast_color' => '#026645',
            'recruitment_enabled' => false
        ]);
        $role5->users()->attach(9);

        $role6 = Role::create([
            'group_level' => 1,
            'order' => 1,
            'name' => 'Chief Executive Officer',
            'icon_name' => 'user-tie',
            'description' => 'Take decisions for the future of OCSC Event.',
            'color' => '#00b579',
            'contrast_color' => '#00422c',
            'recruitment_enabled' => false
        ]);
        $role6->users()->attach(10);
    }
}
