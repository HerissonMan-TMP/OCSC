<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->truncate();
        DB::table('role_user')->truncate();

        //(#1) Chief Executive Officer.
        $role = new Role();
        $role->fill([
            'order' => 1,
            'name' => 'Chief Executive Officer',
            'icon_name' => 'fas fa-user-tie',
            'description' => 'Take decisions for the future of OCSC Event.',
            'color' => '#00b579',
            'contrast_color' => '#00422c',
            'recruitment_enabled' => false
        ]);
        $role->group()->associate(1);
        $role->save();
        $role->users()->attach(1);

        //(#2) Chief Operating Officer.
        $role = new Role();
        $role->fill([
            'order' => 2,
            'name' => 'Chief Operating Officer',
            'icon_name' => 'fas fa-user-tie',
            'description' => 'Help the CEO in taking decisions and manage the whole team.',
            'color' => '#04d992',
            'contrast_color' => '#026645',
            'recruitment_enabled' => false
        ]);
        $role->group()->associate(1);
        $role->save();
        $role->users()->attach(2);

        //(#3) Developer.
        $role = new Role();
        $role->fill([
            'order' => 3,
            'name' => 'Developer',
            'icon_name' => 'fas fa-code',
            'description' => 'Building and developing the website.',
            'color' => '#000000',
            'contrast_color' => '#cfcfcf',
            'recruitment_enabled' => false
        ]);
        $role->group()->associate(1);
        $role->save();
        $role->users()->attach(3);

        //(#4) Community Manager.
        $role = new Role();
        $role->fill([
            'order' => 4,
            'name' => 'Community Manager',
            'icon_name' => 'fas fa-users',
            'description' => 'Dealing with communication & relations between the community and OCSC.',
            'color' => '#cc0439',
            'contrast_color' => '#f2e4e8',
            'recruitment_enabled' => false
        ]);
        $role->group()->associate(2);
        $role->save();
        $role->users()->attach(4);

        //(#5) Event Manager.
        $role = new Role();
        $role->fill([
            'order' => 5,
            'name' => 'Event Manager',
            'icon_name' => 'fas fa-map',
            'description' => 'Managing the Event Team.',
            'color' => '#2f58a3',
            'contrast_color' => '#e3e5e8',
            'recruitment_enabled' => false
        ]);
        $role->group()->associate(2);
        $role->save();
        $role->users()->attach(5);

        //(#6) Support Manager.
        $role = new Role();
        $role->fill([
            'order' => 6,
            'name' => 'Support Manager',
            'icon_name' => 'fas fa-life-ring',
            'description' => 'Managing the Support Team.',
            'color' => '#18b300',
            'contrast_color' => '#eef0ed',
            'recruitment_enabled' => false
        ]);
        $role->group()->associate(2);
        $role->save();
        $role->users()->attach(6);

        //(#7) Translation Manager.
        $role = new Role();
        $role->fill([
            'order' => 7,
            'name' => 'Translation Manager',
            'icon_name' => 'fas fa-language',
            'description' => 'Managing the Translation Team.',
            'color' => '#de21d4',
            'contrast_color' => '#f0edf0',
            'recruitment_enabled' => false
        ]);
        $role->group()->associate(2);
        $role->save();
        $role->users()->attach(7);

        //(#8) Media Manager.
        $role = new Role();
        $role->fill([
            'order' => 8,
            'name' => 'Media Manager',
            'icon_name' => 'fas fa-camera',
            'description' => 'Managing the Media Team.',
            'color' => '#4d1f73',
            'contrast_color' => '#e4d5f0',
            'recruitment_enabled' => false
        ]);
        $role->group()->associate(2);
        $role->save();
        $role->users()->attach(8);

        //(#9) Leader Convoy Control.
        $role = new Role();
        $role->fill([
            'order' => 9,
            'name' => 'Leader Convoy Control',
            'icon_name' => 'fas fa-car',
            'description' => 'Leading the Convoy Control Team.',
            'color' => '#ecf000',
            'contrast_color' => '#858700',
            'recruitment_enabled' => false
        ]);
        $role->group()->associate(3);
        $role->save();
        $role->users()->attach(9);

        //(#10) Convoy Control Team.
        $role = new Role();
        $role->fill([
            'order' => 10,
            'name' => 'Convoy Control Team',
            'icon_name' => 'fas fa-car',
            'description' => 'In charge of supervising convoys and participating VTCs.',
            'color' => '#fcba03',
            'contrast_color' => '#8a6501',
            'recruitment_enabled' => true
        ]);
        $role->group()->associate(3);
        $role->save();
        $role->users()->attach([10, 11, 12]);

        //(#11) Convoy Control Trainee.
        $role = new Role();
        $role->fill([
            'order' => 11,
            'name' => 'Convoy Control Trainee',
            'icon_name' => 'fas fa-car',
            'description' => 'Learning how to become a well-trained Convoy Control.',
            'color' => '#f0ec8b',
            'contrast_color' => '#9e9c64',
            'recruitment_enabled' => false
        ]);
        $role->group()->associate(3);
        $role->save();
        $role->users()->attach([13, 14, 21]);

        //(#12) Event Team.
        $role = new Role();
        $role->fill([
            'order' => 12,
            'name' => 'Event Team',
            'icon_name' => 'fas fa-map',
            'description' => 'In charge of creating future convoy routes / events.',
            'color' => '#3458eb',
            'contrast_color' => '#1a2d78',
            'recruitment_enabled' => true
        ]);
        $role->group()->associate(3);
        $role->save();
        $role->users()->attach([15, 16]);

        //(#13) Support Team.
        $role = new Role();
        $role->fill([
            'order' => 13,
            'name' => 'Support Team',
            'icon_name' => 'fas fa-life-ring',
            'description' => 'In charge of helping users and resolving issues.',
            'color' => '#007508',
            'contrast_color' => '#ededed',
            'recruitment_enabled' => true
        ]);
        $role->group()->associate(3);
        $role->save();
        $role->users()->attach(17);

        //(#14) Translation Team.
        $role = new Role();
        $role->fill([
            'order' => 14,
            'name' => 'Translation Team',
            'icon_name' => 'fas fa-language',
            'description' => 'In charge of translating official content (news post, convoy information, ...).',
            'color' => '#ff9cd6',
            'contrast_color' => '#8c5675',
            'recruitment_enabled' => true
        ]);
        $role->group()->associate(3);
        $role->save();
        $role->users()->attach(18);

        //(#15) Media Team.
        $role = new Role();
        $role->fill([
            'order' => 15,
            'name' => 'Media Team',
            'icon_name' => 'fas fa-camera',
            'description' => 'In charge of taking photos and videos during our convoys and events.',
            'color' => '#770bbf',
            'contrast_color' => '#30054d',
            'recruitment_enabled' => true
        ]);
        $role->group()->associate(3);
        $role->save();
        $role->users()->attach(19);

        //(#16) Official Streamer.
        $role = new Role();
        $role->fill([
            'order' => 16,
            'name' => 'Official Streamer',
            'icon_name' => 'fas fa-tv',
            'description' => 'Streaming convoys & events organized by OCSC.',
            'color' => '#00599e',
            'contrast_color' => '#e6f0f7',
            'recruitment_enabled' => true
        ]);
        $role->group()->associate(3);
        $role->save();
        $role->users()->attach([20, 22]);
    }
}
