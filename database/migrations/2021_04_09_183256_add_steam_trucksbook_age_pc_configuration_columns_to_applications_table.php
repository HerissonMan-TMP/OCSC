<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSteamTrucksbookAgePcConfigurationColumnsToApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->string('pc_configuration')->after('email');
            $table->integer('age')->after('email');
            $table->string('trucksbook_profile')->after('email');
            $table->string('steam_profile')->after('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn(['steam_profile', 'trucksbook_profile', 'age', 'pc_configuration']);
        });
    }
}
