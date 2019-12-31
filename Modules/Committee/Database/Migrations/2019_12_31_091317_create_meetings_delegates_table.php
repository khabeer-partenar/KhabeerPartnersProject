<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingsDelegatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings_delegates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('delegate_id');
            $table->unsignedBigInteger('meeting_id');
            $table->integer('status');
            $table->timestamps();
        });

        Schema::table('meetings_delegates', function (Blueprint $table) {
            $table->foreign('delegate_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('meeting_id')
                ->references('id')
                ->on('meetings')
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
        Schema::dropIfExists('meetings_delegates');
    }
}
