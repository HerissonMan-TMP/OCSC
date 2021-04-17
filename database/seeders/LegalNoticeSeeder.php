<?php

namespace Database\Seeders;

use App\Models\LegalNotice;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LegalNoticeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('legal_notices')->truncate();

        LegalNotice::create([
            'content' => 'This is the legal notice with **markdown** __support__.'
        ]);
    }
}
