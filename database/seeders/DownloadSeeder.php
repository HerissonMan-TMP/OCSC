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
            'name' => 'Test download 1',
            'original_file_name' => 'test_download_1',
            'path' => 'test_download_1',
        ]);
        $download->roles()->attach([9, 10, 11]);

        //(#2) Translation pack [FR].
        $download = Download::create([
            'name' => 'Test download 2',
            'original_file_name' => 'test_download_2',
            'path' => 'test_download_2',
        ]);
        $download->roles()->attach([7, 14]);

        //(#3) Translation pack [DE].
        $download = Download::create([
            'name' => 'Test download 3',
            'original_file_name' => 'test_download_3',
            'path' => 'test_download_3',
        ]);
        $download->roles()->attach([7, 14]);

        //(#4) OCSC Assets.
        $download = Download::create([
            'name' => 'Test download 4',
            'original_file_name' => 'test_download_4',
            'path' => 'test_download_4',
        ]);
        $download->roles()->attach([4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16]);
    }
}
