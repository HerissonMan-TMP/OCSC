<?php

namespace App\Console\Commands;

use App\Models\Group;
use App\Models\Role;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GenerateRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'roles:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store the default roles for production in the database.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $continue = true;

        if (!Group::exists()) {
            $this->error('You must add data in the groups table before.');
        }

        if (Role::exists()) {
            $continue = $this->confirm('The roles table is not empty. By continuing, the current data will be deleted and replaced by new ones. Do you want to continue?');
        }

        if ($continue) {
            DB::table('roles')->delete();

            //Chief Executive Officer.
            Role::create([
                'group_id' => Group::where('name', 'Administrators')->first()->id,
                'order' => 1,
                'name' => 'Chief Executive Officer',
                'icon_name' => 'fas fa-user-tie',
                'description' => 'Take decisions for the future of OCSC Event.',
                'color' => '#00b579',
                'contrast_color' => '#00422c',
                'recruitment_enabled' => false
            ]);

            //Chief Operating Officer.
            Role::create([
                'group_id' => Group::where('name', 'Administrators')->first()->id,
                'order' => 2,
                'name' => 'Chief Operating Officer',
                'icon_name' => 'fas fa-user-tie',
                'description' => 'Help the CEO in taking decisions and manage the whole team.',
                'color' => '#04d992',
                'contrast_color' => '#026645',
                'recruitment_enabled' => false
            ]);

            //Developer.
            Role::create([
                'group_id' => Group::where('name', 'Administrators')->first()->id,
                'order' => 3,
                'name' => 'Developer',
                'icon_name' => 'fas fa-code',
                'description' => 'Building and developing the website.',
                'color' => '#000000',
                'contrast_color' => '#cfcfcf',
                'recruitment_enabled' => false
            ]);

            //Community Manager.
            Role::create([
                'group_id' => Group::where('name', 'Managers')->first()->id,
                'order' => 4,
                'name' => 'Community Manager',
                'icon_name' => 'fas fa-users',
                'description' => 'Dealing with communication & relations between the community and OCSC.',
                'color' => '#cc0439',
                'contrast_color' => '#f2e4e8',
                'recruitment_enabled' => false
            ]);

            //Event Manager.
            Role::create([
                'group_id' => Group::where('name', 'Managers')->first()->id,
                'order' => 5,
                'name' => 'Event Manager',
                'icon_name' => 'fas fa-map',
                'description' => 'Managing the Event Team.',
                'color' => '#2f58a3',
                'contrast_color' => '#e3e5e8',
                'recruitment_enabled' => false
            ]);

            //Support Manager.
            Role::create([
                'group_id' => Group::where('name', 'Managers')->first()->id,
                'order' => 6,
                'name' => 'Support Manager',
                'icon_name' => 'fas fa-life-ring',
                'description' => 'Managing the Support Team.',
                'color' => '#18b300',
                'contrast_color' => '#eef0ed',
                'recruitment_enabled' => false
            ]);

            //Translation Manager.
            Role::create([
                'group_id' => Group::where('name', 'Managers')->first()->id,
                'order' => 7,
                'name' => 'Translation Manager',
                'icon_name' => 'fas fa-language',
                'description' => 'Managing the Translation Team.',
                'color' => '#de21d4',
                'contrast_color' => '#f0edf0',
                'recruitment_enabled' => false
            ]);

            //Media Manager.
            Role::create([
                'group_id' => Group::where('name', 'Managers')->first()->id,
                'order' => 8,
                'name' => 'Media Manager',
                'icon_name' => 'fas fa-camera',
                'description' => 'Managing the Media Team.',
                'color' => '#4d1f73',
                'contrast_color' => '#e4d5f0',
                'recruitment_enabled' => false
            ]);

            //Leader Convoy Control.
            Role::create([
                'group_id' => Group::where('name', 'Staff')->first()->id,
                'order' => 9,
                'name' => 'Leader Convoy Control',
                'icon_name' => 'fas fa-car',
                'description' => 'Leading the Convoy Control Team.',
                'color' => '#ecf000',
                'contrast_color' => '#858700',
                'recruitment_enabled' => false
            ]);

            //(Convoy Control Team.
            Role::create([
                'group_id' => Group::where('name', 'Staff')->first()->id,
                'order' => 10,
                'name' => 'Convoy Control Team',
                'icon_name' => 'fas fa-car',
                'description' => 'In charge of supervising convoys and participating VTCs.',
                'color' => '#fcba03',
                'contrast_color' => '#8a6501',
                'recruitment_enabled' => true
            ]);

            //(Convoy Control Trainee.
            Role::create([
                'group_id' => Group::where('name', 'Staff')->first()->id,
                'order' => 11,
                'name' => 'Convoy Control Trainee',
                'icon_name' => 'fas fa-car',
                'description' => 'Learning how to become a well-trained Convoy Control.',
                'color' => '#f0ec8b',
                'contrast_color' => '#9e9c64',
                'recruitment_enabled' => false
            ]);

            //(Event Team.
            Role::create([
                'group_id' => Group::where('name', 'Staff')->first()->id,
                'order' => 12,
                'name' => 'Event Team',
                'icon_name' => 'fas fa-map',
                'description' => 'In charge of creating future convoy routes / events.',
                'color' => '#3458eb',
                'contrast_color' => '#1a2d78',
                'recruitment_enabled' => true
            ]);

            //(Support Team.
            Role::create([
                'group_id' => Group::where('name', 'Staff')->first()->id,
                'order' => 13,
                'name' => 'Support Team',
                'icon_name' => 'fas fa-life-ring',
                'description' => 'In charge of helping users and resolving issues.',
                'color' => '#007508',
                'contrast_color' => '#ededed',
                'recruitment_enabled' => true
            ]);

            //(Translation Team.
            Role::create([
                'group_id' => Group::where('name', 'Staff')->first()->id,
                'order' => 14,
                'name' => 'Translation Team',
                'icon_name' => 'fas fa-language',
                'description' => 'In charge of translating official content (news post, convoy information, ...).',
                'color' => '#ff9cd6',
                'contrast_color' => '#8c5675',
                'recruitment_enabled' => true
            ]);

            //(Media Team.
            Role::create([
                'group_id' => Group::where('name', 'Staff')->first()->id,
                'order' => 15,
                'name' => 'Media Team',
                'icon_name' => 'fas fa-camera',
                'description' => 'In charge of taking photos and videos during our convoys and events.',
                'color' => '#770bbf',
                'contrast_color' => '#30054d',
                'recruitment_enabled' => true
            ]);

            //(Official Streamer.
            Role::create([
                'group_id' => Group::where('name', 'Staff')->first()->id,
                'order' => 16,
                'name' => 'Official Streamer',
                'icon_name' => 'fas fa-tv',
                'description' => 'Streaming convoys & events organized by OCSC.',
                'color' => '#00599e',
                'contrast_color' => '#e6f0f7',
                'recruitment_enabled' => true
            ]);

            $this->info('The roles have been successfully stored!');
        }

        return 0;
    }
}
