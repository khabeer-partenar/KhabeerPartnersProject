<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCoordinatorsTableWithDepartmentColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coordinators', function (Blueprint $table) {
            $table->string('main_department_id')->after('phone_number');
            $table->string('parent_department_id')->after('main_department_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coordinators', function (Blueprint $table) {
            $table->dropColumn('main_department_id');
            $table->dropColumn('parent_department_id');
        });
    }
}
