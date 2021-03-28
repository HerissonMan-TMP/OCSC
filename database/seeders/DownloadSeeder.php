<?php

namespace Database\Seeders;

use App\Models\Download;
use Illuminate\Database\Seeder;

class DownloadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Convoy Control Save
        $download = Download::create([
            'name' => 'CC Save',
            'link' => 'https://test.com/cc-save',
        ]);
        $download->roles()->attach([1, 2]);

        //Translation pack [FR]
        $download = Download::create([
            'name' => 'Translation pack [FR]',
            'link' => 'https://test.com/translation-pack-fr',
        ]);
        $download->roles()->attach(4);

        //Translation pack [DE]
        $download = Download::create([
            'name' => 'Translation pack [DE]',
            'link' => 'https://test.com/translation-pack-de',
        ]);
        $download->roles()->attach(4);
    }
}
