<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeMeetingIdNullableInMeetingsMultimediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('meeting_multimedia', 'committee_multimedia');

        Schema::table('committee_multimedia', function (Blueprint $table) {
            $table->unsignedBigInteger('meeting_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('committee_multimedia', 'meeting_multimedia');

        Schema::table('meeting_multimedia', function (Blueprint $table) {
            $table->unsignedBigInteger('meeting_id')->change();
        });
    }
}
