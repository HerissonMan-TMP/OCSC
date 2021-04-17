<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\ActivityType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('activities')->truncate();

        //5 "logged in" activities.
        $activityType = ActivityType::find(4);
        Activity::factory(5)
                ->for($activityType, 'type')
                ->withoutSubject()
                ->create();

        //5 "logged out" activities.
        $activityType = ActivityType::find(5);
        Activity::factory(5)
            ->for($activityType, 'type')
            ->withoutSubject()
            ->create();

        //5 "created" activities.
        $activityType = ActivityType::find(1);
        Activity::factory(5)
            ->for($activityType, 'type')
            ->create();

        //5 "updated" activities.
        $activityType = ActivityType::find(2);
        Activity::factory(5)
            ->for($activityType, 'type')
            ->create();

        //5 "deleted" activities.
        $activityType = ActivityType::find(3);
        Activity::factory(5)
            ->for($activityType, 'type')
            ->create();

        //5 "subscribed" activities.
        $activityType = ActivityType::find(6);
        Activity::factory(5)
            ->for($activityType, 'type')
            ->withoutSubject()
            ->create();

        //1 "enabled" activity.
        $activityType = ActivityType::find(13);
        Activity::factory(1)
            ->for($activityType, 'type')
            ->state([
                'subject_icon' => 'fas fa-wrench',
                'subject' => 'Maintenance mode'
            ])
            ->create();
    }
}
