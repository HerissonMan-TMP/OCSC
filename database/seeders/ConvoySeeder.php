<?php

namespace Database\Seeders;

use App\Models\Convoy;
use Illuminate\Database\Seeder;

class ConvoySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Convoy::create([
            'truckersmp_event_id' => 896,
            'distance' => 1524,
            'meetup_date' => '2021-03-08 20:30',
        ]);

        Convoy::create([
            'truckersmp_event_id' => 1526,
            'distance' => 950,
            'meetup_date' => '2021-03-21 13:10',
        ]);

        Convoy::create([
            'truckersmp_event_id' => 1577,
            'distance' => 1276,
            'meetup_date' => '2021-03-27 20:30',
        ]);

        Convoy::create([
            'truckersmp_event_id' => 904,
            'distance' => 1109,
            'meetup_date' => '2021-04-17 20:00',
        ]);
    }
}
