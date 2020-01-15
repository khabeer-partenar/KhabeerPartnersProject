<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorizedNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authorized_names', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('guest_id')->nullable();
            $table->bigInteger('national_id');
            $table->unsignedBigInteger('religion_id');
            $table->string('name')->nullable();
            $table->string('job');
            $table->string('nationality')->nullable();
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('advisor_id');
            $table->dateTime('entry_time');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authorized_names');
    }
}
