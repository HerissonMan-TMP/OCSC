<?php

namespace Database\Seeders;

use App\Models\Convoy;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConvoySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('convoys')->truncate();

        //(#1) Past convoy "Test convoy 1".
        Convoy::create([
            'truckersmp_event_id' => 896,
            'title' => 'Test convoy 1',
            'banner_url' => 'https://static.truckersmp.com/images/event/cover/896.1613262466.jpeg',
            'location' => 'Frankfurt',
            'distance' => 1142,
            'destination' => 'Civaux',
            'server' => 'Simulation 2',
            'meetup_date' => '2021-03-27 20:30',
        ]);

        //(#2) Upcoming convoy "Test convoy 2".
        Convoy::create([
            'truckersmp_event_id' => 1577,
            'title' => 'Test convoy 2',
            'banner_url' => 'https://static.truckersmp.com/images/event/cover/1577.1615296677.jpeg',
            'location' => 'Other',
            'distance' => 1270,
            'destination' => 'Other',
            'server' => 'ProMods',
            'meetup_date' => '2021-04-30 20:30',
        ]);

        //(#3) Upcoming convoy "Test convoy 3".
        Convoy::create([
            'truckersmp_event_id' => 904,
            'title' => 'Test convoy 3',
            'banner_url' => 'https://static.truckersmp.com/images/event/cover/904.1612746219.jpeg',
            'location' => 'Munich',
            'distance' => 1176,
            'destination' => 'Wrocław',
            'server' => 'To be determined',
            'meetup_date' => '2021-05-17 19:00',
        ]);

        //(#4) Upcoming convoy "Test convoy 4".
        Convoy::create([
            'truckersmp_event_id' => 1,
            'title' => 'Test convoy 4',
            'location' => 'Paris',
            'distance' => 1000,
            'destination' => 'Marseille',
            'server' => 'Event Server',
            'meetup_date' => '2021-05-25 19:00',
        ]);
    }
}
