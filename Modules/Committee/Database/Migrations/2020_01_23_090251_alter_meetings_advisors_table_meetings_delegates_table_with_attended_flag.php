<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMeetingsAdvisorsTableMeetingsDelegatesTableWithAttendedFlag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meetings_advisors', function (Blueprint $table) {
            $table->boolean('attended')->default(0)->after('status');

            $table->unsignedBigInteger('attendance_taker_id')->nullable()->after('attended');

            $table->foreign('attendance_taker_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        Schema::table('meetings_delegates', function (Blueprint $table) {
            $table->boolean('attended')->default(0)->after('status');

            $table->unsignedBigInteger('attendance_taker_id')->nullable()->after('attended');

            $table->foreign('attendance_taker_id')
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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Schema::table('meetings_advisors', function (Blueprint $table) {
            $table->dropForeign('khabeer_meetings_advisors_attendance_taker_id_foreign');
            $table->dropColumn('attended');
            $table->dropColumn('attendance_taker_id');
        });

        Schema::table('meetings_delegates', function (Blueprint $table) {
            $table->dropForeign('khabeer_meetings_delegates_attendance_taker_id_foreign');
            $table->dropColumn('attended');
            $table->dropColumn('attendance_taker_id');
        });

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
