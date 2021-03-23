<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        setting(['global-requirements' => '- requirement 1'])->save();
        setting(['convoy-rules' => 'The convoy rules *with* **markdown**.'])->save();
        setting(['legal-notice' => 'The **legal notice**.'])->save();
        setting(['privacy-policy' => 'The **privacy policy**.'])->save();
    }
}
