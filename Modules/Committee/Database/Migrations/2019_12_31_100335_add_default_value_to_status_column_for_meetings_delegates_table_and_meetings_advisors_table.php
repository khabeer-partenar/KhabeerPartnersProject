<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultValueToStatusColumnForMeetingsDelegatesTableAndMeetingsAdvisorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meetings_delegates', function (Blueprint $table) {
            $table->integer('status')->default('0')->change();
        });

        Schema::table('meetings_advisors', function (Blueprint $table) {
            $table->integer('status')->default('0')->change();
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
            $table->integer('status')->change();
        });

        Schema::table('meetings_advisors', function (Blueprint $table) {
            $table->integer('status')->change();
        });
    }
}
