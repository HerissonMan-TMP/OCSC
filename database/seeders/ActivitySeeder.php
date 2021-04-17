<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $activity = new Activity;
        $activity->fill([
            'subject_icon' => 'fas fa-newspaper',
            'subject' => 'Article #4',
        ]);
        $activity->causer()->associate(1);
        $activity->type()->associate(1);
        $activity->save();

        $activity = new Activity;
        $activity->fill([
            'description' => 'test@test.com',
        ]);
        $activity->type()->associate(5);
        $activity->save();

        $activity = new Activity;
        $activity->fill([
            'subject_icon' => 'fas fa-image',
            'subject' => 'Picture #16',
        ]);
        $activity->causer()->associate(4);
        $activity->type()->associate(3);
        $activity->save();

        $activity = new Activity;
        $activity->fill([
            'subject_icon' => 'fas fa-newspaper',
            'subject' => 'Article #4',
        ]);
        $activity->causer()->associate(1);
        $activity->type()->associate(2);
        $activity->save();
    }
}
