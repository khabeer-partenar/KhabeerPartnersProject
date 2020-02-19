<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeAttendedFlagNullableInMeetingsDelegatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meetings_delegates', function (Blueprint $table) {
            $table->boolean('attended')->nullable()->after('status')->change();
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
            $table->boolean('attended')->default('0')->after('status')->change();
        });
    }
}
