<?php

namespace Database\Seeders;

use App\Models\PrivacyPolicy;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrivacyPolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('privacy_policies')->truncate();

        PrivacyPolicy::create([
            'content' => 'This is the privacy policy with **markdown** __support__.'
        ]);
    }
}
