<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoordinatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coordinators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('national_id')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->integer('direct_department_id');
            $table->timestamp('email_verified_at')->nullable();
            //$table->string('password');
            $table->softDeletes();
            $table->integer('job_role_id')->references('id')->on('khabeer_core_groups');
            $table->rememberToken();
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
        Schema::dropIfExists('coordinators');
    }
}