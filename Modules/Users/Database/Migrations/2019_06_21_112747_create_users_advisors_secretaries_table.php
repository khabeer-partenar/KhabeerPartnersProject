<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersAdvisorsSecretariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_advisors_secretaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('advisor_user_id')->references('id')->on('users');
            $table->integer('secretary_user_id')->references('id')->on('users');
            $table->timestamps();

            //$table->unique(['advisor_user_id', 'secretary_user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_advisors_secretaries');
    }
}
