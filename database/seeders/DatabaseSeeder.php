<?php

namespace Database\Seeders;

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
        DB::table('users')->truncate();
        DB::table('roles')->truncate();
        DB::table('role_user')->truncate();
        DB::table('permissions')->truncate();
        DB::table('permission_role')->truncate();
        DB::table('recruitments')->truncate();
        DB::table('questions')->truncate();
        DB::table('applications')->truncate();
        DB::table('answers')->truncate();
        DB::table('contact_messages')->truncate();
        DB::table('contact_categories')->truncate();
        DB::table('convoys')->truncate();
        DB::table('settings')->truncate();
        DB::table('download_role')->truncate();
        DB::table('downloads')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
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
        ]);
    }
}
