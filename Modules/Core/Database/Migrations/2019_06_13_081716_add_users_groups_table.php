<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsersGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_users_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('core_group_id')->references('id')->on('core_groups');;
            $table->integer('user_id')->references('user_id')->on('mu_users');
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
        Schema::drop('core_users_groups');
    }
}
