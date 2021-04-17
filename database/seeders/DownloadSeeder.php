<?php

namespace Database\Seeders;

use App\Models\Download;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DownloadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('downloads')->truncate();
        DB::table('download_role')->truncate();

        //(#1) Convoy Control Save.
        $download = Download::create([
            'name' => 'CC Save',
            'link' => 'https://test.com/cc-save',
        ]);
        $download->roles()->attach([9, 10, 11]);

        //(#2) Translation pack [FR].
        $download = Download::create([
            'name' => 'Translation pack [FR]',
            'link' => 'https://test.com/translation-pack-fr',
        ]);
        $download->roles()->attach([7, 14]);

        //(#3) Translation pack [DE].
        $download = Download::create([
            'name' => 'Translation pack [DE]',
            'link' => 'https://test.com/translation-pack-de',
        ]);
        $download->roles()->attach([7, 14]);

        //(#4) OCSC Assets.
        $download = Download::create([
            'name' => 'OCSC Assets',
            'link' => 'https://test.com/ocsc-assets',
        ]);
        $download->roles()->attach([4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16]);
    }
}
