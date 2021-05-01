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

        Convoy::insert([
            [
                'truckersmp_event_id' => 166,
            ],
            [
                'truckersmp_event_id' => 895,
            ],
            [
                'truckersmp_event_id' => 2664,
            ],
            [
                'truckersmp_event_id' => 2665,
            ],
            [
                'truckersmp_event_id' => 2062,
            ],
            [
                'truckersmp_event_id' => 1031,
            ],
            [
                'truckersmp_event_id' => 2442,
            ],
        ]);
    }
}
