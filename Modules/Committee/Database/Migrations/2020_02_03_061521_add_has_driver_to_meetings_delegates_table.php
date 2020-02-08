<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHasDriverToMeetingsDelegatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meetings_delegates', function (Blueprint $table) {
            $table->integer('has_driver')->nullable();
            $table->unsignedBigInteger('driver_id')->nullable();

            $table->foreign('driver_id')
            ->references('id')
            ->on('delegate_driver')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meetings_delegates', function (Blueprint $table) {
            $table->dropColumn('has_driver');
            $table->dropColumn('driver_id');
        });
    }
}
