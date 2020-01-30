<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDelegateDriverTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delegate_driver', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('national_id');
            $table->string('name')->nullable();
            $table->string('nationality')->nullable();
            $table->unsignedBigInteger('nationality_id')->nullable();
            $table->unsignedBigInteger('religion_id');
            $table->timestamps();
        });

        Schema::table('delegate_driver', function (Blueprint $table) {
            $table->foreign('nationality_id')
                ->references('id')
                ->on('nationalities')
                ->onDelete('cascade');
            $table->foreign('religion_id')
                ->references('id')
                ->on('religions')
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
        Schema::dropIfExists('delegate_driver');
    }
}
