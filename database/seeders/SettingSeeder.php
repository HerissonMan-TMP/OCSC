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
        //Global Requirements (for recruitments)
        setting(['global-requirements' => '- requirement 1'])->save();

        //Convoy Rules
        setting(['convoy-rules' => 'The convoy rules *with* **markdown**.'])->save();

        //Legal Notice
        setting(['legal-notice' => 'The **legal notice**.'])->save();

        //Privacy Policy
        setting(['privacy-policy' => 'The **privacy policy**.'])->save();

        //Cookie Policy
        setting(['cookie-policy' => 'The **cookie policy**.'])->save();
    }
}
