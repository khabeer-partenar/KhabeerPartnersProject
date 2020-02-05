<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDepartmentIdToMeetingsDelegatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meetings_delegates', function (Blueprint $table) {
            $table->unsignedBigInteger('department_id')->after('delegate_id');

            $table->foreign('department_id')
                ->references('id')
                ->on('departments')
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
        Schema::table('meetings_delegates', function (Blueprint $table) {
            $table->dropForeign('khabeer_meetings_delegates_department_id_foreign');
            $table->dropColumn('department_id');
        });
    }
}
