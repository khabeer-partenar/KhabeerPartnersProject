<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTableWithCoordinatorsTableColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('main_department_id')->after('phone_number');
            $table->string('parent_department_id')->after('main_department_id');
            $table->string('department_reference')->default(0)->after('direct_department_id');
            $table->string('title')->nullable()->after('department_reference');
            $table->string('job_title')->nullable()->after('title');
            $table->boolean('is_coordinator')->default(0)->after('job_role_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('main_department_id');
            $table->dropColumn('parent_department_id');
            $table->dropColumn('department_reference');
            $table->dropColumn('title');
            $table->dropColumn('job_title');
            $table->dropColumn('is_coordinator');
        });
    }
}
