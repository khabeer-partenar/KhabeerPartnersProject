<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reason');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('room_id');
            $table->dateTime('from');
            $table->dateTime('to');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('meetings', function (Blueprint $table) {
            $table->foreign('type_id')
                ->references('id')
                ->on('meetings_types')
                ->onDelete('cascade');

            $table->foreign('room_id')
                ->references('id')
                ->on('meetings_rooms')
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
        Schema::table('meetings', function (Blueprint $table) {
            $table->dropForeign('khabeer_meetings_room_id_foreign');
            $table->dropForeign('khabeer_meetings_type_id_foreign');
        });
        Schema::dropIfExists('meetings');
    }
}
