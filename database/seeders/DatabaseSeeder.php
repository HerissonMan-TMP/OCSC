<?php

namespace Database\Seeders;

use App\Models\GlobalRequirements;
use App\Models\PermissionCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $this->call([
            UserSeeder::class,
            GroupSeeder::class,
            RoleSeeder::class,
            PermissionCategorySeeder::class,
            PermissionSeeder::class,
            RecruitmentSeeder::class,
            QuestionSeeder::class,
            ApplicationSeeder::class,
            AnswerSeeder::class,
            ContactCategorySeeder::class,
            ContactMessageSeeder::class,
            ConvoySeeder::class,
            SettingSeeder::class,
            DownloadSeeder::class,
            ArticleSeeder::class,
            PictureSeeder::class,
            ActivityTypeSeeder::class,
            ActivitySeeder::class,
            PrivacyPolicySeeder::class,
            LegalNoticeSeeder::class,
            GlobalRequirementsSeeder::class,
            ConvoyRulesSeeder::class,
            PartnerCategorySeeder::class,
            PartnerSeeder::class,
            PartnershipConditionsSeeder::class,
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
