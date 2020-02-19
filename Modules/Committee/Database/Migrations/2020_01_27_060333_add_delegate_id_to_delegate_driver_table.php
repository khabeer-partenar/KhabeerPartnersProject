<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDelegateIdToDelegateDriverTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('delegate_driver', function (Blueprint $table) {
            $table->unsignedBigInteger('delegate_id')->nullable();

        });

        Schema::table('delegate_driver', function (Blueprint $table) {
            $table->foreign('delegate_id')
                ->references('id')
                ->on('users')
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
        Schema::table('delegate_driver', function (Blueprint $table) {

        });
    }
}
