<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMeetingsTableWithNullableColumnsForFirstMeeting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Schema::dropIfExists('meetings');

        Schema::create('meetings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reason')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('type_id')->nullable();
            $table->unsignedBigInteger('room_id')->nullable();
            $table->unsignedBigInteger('committee_id')->nullable();
            $table->dateTime('from');
            $table->dateTime('to')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('meetings', function (Blueprint $table) {
            $table->foreign('committee_id')
                ->references('id')
                ->on('committees')
                ->onDelete('cascade');

            $table->foreign('type_id')
                ->references('id')
                ->on('meetings_types')
                ->onDelete('cascade');

            $table->foreign('room_id')
                ->references('id')
                ->on('meetings_rooms')
                ->onDelete('cascade');
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Schema::dropIfExists('meetings');

        Schema::create('meetings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reason');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('committee_id')->nullable();
            $table->dateTime('from');
            $table->dateTime('to');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('meetings', function (Blueprint $table) {
            $table->foreign('committee_id')
                ->references('id')
                ->on('committees')
                ->onDelete('cascade');

            $table->foreign('type_id')
                ->references('id')
                ->on('meetings_types')
                ->onDelete('cascade');

            $table->foreign('room_id')
                ->references('id')
                ->on('meetings_rooms')
                ->onDelete('cascade');
        });

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
