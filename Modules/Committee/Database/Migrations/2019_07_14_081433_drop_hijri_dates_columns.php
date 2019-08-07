<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropHijriDatesColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('committees', function (Blueprint $table) {
            $table->dropColumn('treatment_time_hijri');
            $table->dropColumn('resource_at_hijri');
            $table->dropColumn('outgoing_at_hijri');
            $table->dropColumn('first_meeting_at_hijri');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('committees', function (Blueprint $table) {
            $table->string('treatment_time_hijri');
            $table->string('resource_at_hijri');
            $table->string('outgoing_at_hijri');
            $table->string('first_meeting_at_hijri');
        });
    }
}
