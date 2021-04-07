<?php

namespace Database\Seeders;

use App\Models\Picture;
use App\Models\User;
use Illuminate\Database\Seeder;
use Storage;

class PictureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 6; $i++) {
            $user = User::inRandomOrder()->first();
            Picture::factory(5)->for($user)->create();
        }
    }
}
