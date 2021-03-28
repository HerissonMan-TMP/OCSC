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
        //Chief Executive Officer
        $role = Role::create([
            'group_level' => 1,
            'order' => 1,
            'name' => 'Chief Executive Officer',
            'icon_name' => 'user-tie',
            'description' => 'Take decisions for the future of OCSC Event.',
            'color' => '#00b579',
            'contrast_color' => '#00422c',
            'recruitment_enabled' => false
        ]);
        $role->users()->attach(1);

        //Chief Operating Officer
        $role = Role::create([
            'group_level' => 1,
            'order' => 2,
            'name' => 'Chief Operating Officer',
            'icon_name' => 'user-tie',
            'description' => 'Help the CEO in taking decisions and manage the whole team.',
            'color' => '#04d992',
            'contrast_color' => '#026645',
            'recruitment_enabled' => false
        ]);
        $role->users()->attach(2);

        //Developer
        $role = Role::create([
            'group_level' => 1,
            'order' => 3,
            'name' => 'Developer',
            'icon_name' => 'code',
            'description' => 'Building and developing the website.',
            'color' => '#000000',
            'contrast_color' => '#cfcfcf',
            'recruitment_enabled' => false
        ]);
        $role->users()->attach(3);

        //Community Manager
        $role = Role::create([
            'group_level' => 2,
            'order' => 4,
            'name' => 'Community Manager',
            'icon_name' => 'users',
            'description' => 'Dealing with communication & relations between the community and OCSC.',
            'color' => '#cc0439',
            'contrast_color' => '#f2e4e8',
            'recruitment_enabled' => false
        ]);
        $role->users()->attach(4);

        //Event Manager
        $role = Role::create([
            'group_level' => 2,
            'order' => 5,
            'name' => 'Event Manager',
            'icon_name' => 'map',
            'description' => 'Managing the Event Team.',
            'color' => '#2f58a3',
            'contrast_color' => '#e3e5e8',
            'recruitment_enabled' => false
        ]);
        $role->users()->attach(5);

        //Support Manager
        $role = Role::create([
            'group_level' => 2,
            'order' => 6,
            'name' => 'Support Manager',
            'icon_name' => 'life-ring',
            'description' => 'Managing the Support Team.',
            'color' => '#18b300',
            'contrast_color' => '#eef0ed',
            'recruitment_enabled' => false
        ]);
        $role->users()->attach(6);

        //Translation Manager
        $role = Role::create([
            'group_level' => 2,
            'order' => 7,
            'name' => 'Translation Manager',
            'icon_name' => 'language',
            'description' => 'Managing the Translation Team.',
            'color' => '#de21d4',
            'contrast_color' => '#f0edf0',
            'recruitment_enabled' => false
        ]);
        $role->users()->attach(7);

        //Media Manager
        $role = Role::create([
            'group_level' => 2,
            'order' => 8,
            'name' => 'Media Manager',
            'icon_name' => 'camera',
            'description' => 'Managing the Media Team.',
            'color' => '#4d1f73',
            'contrast_color' => '#e4d5f0',
            'recruitment_enabled' => false
        ]);
        $role->users()->attach(8);

        //Leader Convoy Control
        $role = Role::create([
            'group_level' => 3,
            'order' => 9,
            'name' => 'Leader Convoy Control',
            'icon_name' => 'car',
            'description' => 'Leading the Convoy Control Team.',
            'color' => '#ecf000',
            'contrast_color' => '#858700',
            'recruitment_enabled' => false
        ]);
        $role->users()->attach(9);

        //Convoy Control Team
        $role = Role::create([
            'group_level' => 3,
            'order' => 10,
            'name' => 'Convoy Control Team',
            'icon_name' => 'car',
            'description' => 'In charge of supervising convoys and participating VTCs.',
            'color' => '#fcba03',
            'contrast_color' => '#8a6501',
            'recruitment_enabled' => true
        ]);
        $role->users()->attach([10, 11, 12]);

        //Convoy Control Trainee
        $role = Role::create([
            'group_level' => 3,
            'order' => 11,
            'name' => 'Convoy Control Trainee',
            'icon_name' => 'car',
            'description' => 'Learning how to become a well-trained Convoy Control.',
            'color' => '#f0ec8b',
            'contrast_color' => '#9e9c64',
            'recruitment_enabled' => false
        ]);
        $role->users()->attach([13, 14, 21]);

        //Event Team
        $role = Role::create([
            'group_level' => 3,
            'order' => 12,
            'name' => 'Event Team',
            'icon_name' => 'map',
            'description' => 'In charge of creating future convoy routes / events.',
            'color' => '#3458eb',
            'contrast_color' => '#1a2d78',
            'recruitment_enabled' => true
        ]);
        $role->users()->attach([15, 16]);

        //Support Team
        $role = Role::create([
            'group_level' => 3,
            'order' => 13,
            'name' => 'Support Team',
            'icon_name' => 'life-ring',
            'description' => 'In charge of helping users and resolving issues.',
            'color' => '#007508',
            'contrast_color' => '#ededed',
            'recruitment_enabled' => true
        ]);
        $role->users()->attach(17);

        //Translation Team
        $role = Role::create([
            'group_level' => 3,
            'order' => 14,
            'name' => 'Translation Team',
            'icon_name' => 'language',
            'description' => 'In charge of translating official content (news post, convoy information, ...).',
            'color' => '#ff9cd6',
            'contrast_color' => '#8c5675',
            'recruitment_enabled' => true
        ]);
        $role->users()->attach(18);

        //Media Team
        $role = Role::create([
            'group_level' => 3,
            'order' => 15,
            'name' => 'Media Team',
            'icon_name' => 'camera',
            'description' => 'In charge of taking photos and videos during our convoys and events.',
            'color' => '#770bbf',
            'contrast_color' => '#30054d',
            'recruitment_enabled' => true
        ]);
        $role->users()->attach(19);

        //Official Streamer
        $role = Role::create([
            'group_level' => 3,
            'order' => 16,
            'name' => 'Official Streamer',
            'icon_name' => 'tv',
            'description' => 'Streaming convoys & events organized by OCSC.',
            'color' => '#00599e',
            'contrast_color' => '#e6f0f7',
            'recruitment_enabled' => true
        ]);
        $role->users()->attach(20);
    }
}
