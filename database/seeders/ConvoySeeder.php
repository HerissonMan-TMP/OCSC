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
            'title' => 'OCSC Event🚕🚚🚛| International Women\'s Day',
            'banner_url' => 'https://static.truckersmp.com/images/event/cover/896.1613262466.jpeg',
            'location' => 'Frankfurt',
            'distance' => 1142,
            'destination' => 'Civaux',
            'server' => 'Simulation 2',
            'meetup_date' => '2021-03-08 20:30',
        ]);

        Convoy::create([
            'truckersmp_event_id' => 1577,
            'title' => 'OCSC Event🚕🚚🚛| Truck Brand Event : SCANIA !',
            'banner_url' => 'https://static.truckersmp.com/images/event/cover/1577.1615296677.jpeg',
            'location' => 'Other',
            'distance' => 1270,
            'destination' => 'Other',
            'server' => 'ProMods',
            'meetup_date' => '2021-03-27 20:30',
        ]);

        Convoy::create([
            'truckersmp_event_id' => 904,
            'title' => 'OCSC Event🚕🚚🚛| Monthly Mega - April',
            'banner_url' => 'https://static.truckersmp.com/images/event/cover/904.1612746219.jpeg',
            'location' => 'Munich',
            'distance' => 1176,
            'destination' => 'Wrocław',
            'server' => 'To be determined',
            'meetup_date' => '2021-04-17 19:00',
        ]);

        Convoy::create([
            'truckersmp_event_id' => 904,
            'title' => 'OCSC Event🚕🚚🚛| Test',
            'banner_url' => '',
            'location' => 'Paris',
            'distance' => 1000,
            'destination' => 'Marseille',
            'server' => 'Event Server',
            'meetup_date' => '2021-04-25 19:00',
        ]);
    }
}
