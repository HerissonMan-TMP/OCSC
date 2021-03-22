<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInConvoysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('convoys', function (Blueprint $table) {
            $table->string('location')->after('truckersmp_event_id');
            $table->string('banner_url')->nullable()->after('truckersmp_event_id');
            $table->string('title')->after('truckersmp_event_id');
            $table->string('server')->after('distance');
            $table->string('destination')->after('distance');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('convoys', function (Blueprint $table) {
            $table->dropColumn('location');
            $table->dropColumn('banner_url');
            $table->dropColumn('title');
            $table->dropColumn('server');
            $table->dropColumn('destination');
        });
    }
}
