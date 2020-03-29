<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropDirectManagerIdColumnFromDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('departments', function (Blueprint $table) {
            $table->dropColumn('direct_manager_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('departments', function (Blueprint $table) {
            $table->bigInteger('direct_manager_id')->nullable();
        });
    }
}
