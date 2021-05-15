<?php

namespace Database\Seeders;

use App\Models\GlobalRequirements;
use App\Models\PermissionCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     * @throws \Doctrine\DBAL\Exception
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        $tableNames = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();
        foreach ($tableNames as $name) {
            if ($name === 'migrations') {
                continue;
            }
            DB::table($name)->truncate();
        }

        $this->call([
            GroupSeeder::class,
            RoleSeeder::class,
            PermissionCategorySeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
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
            GuideSeeder::class,
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
