<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCoordinatorsTableWithSomeMoreColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coordinators', function (Blueprint $table) {
            $table->string('department_reference')->after('direct_department_id');
            $table->string('title')->nullable()->after('department_reference');
            $table->string('job_title')->nullable()->after('title');
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
            $table->dropColumn('department_reference');
            $table->dropColumn('title');
            $table->dropColumn('job_title');
        });
    }
}
