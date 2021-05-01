<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteConvoysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('convoys');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('convoys', function (Blueprint $table) {
            $table->id();
            $table->integer('truckersmp_event_id');
            $table->timestamp('meetup_date');
            $table->string('title');
            $table->string('banner_url')->nullable();
            $table->string('location');
            $table->integer('distance')->nullable();
            $table->string('destination');
            $table->string('server');
            $table->timestamps();
        });
    }
}
