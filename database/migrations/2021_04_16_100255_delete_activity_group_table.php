<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteActivityGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('activity_group');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('activity_group', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_id')->constrained('activity_log');
            $table->foreignId('group_id')->constrained();
            $table->timestamps();
        });
    }
}
