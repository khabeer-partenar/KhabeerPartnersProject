<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Committee\Entities\Committee;
use Modules\Users\Entities\User;

class CommitteesParticipantAdvisors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('committees_participant_advisors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('committee_id');
            $table->integer('advisor_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('committees_participant_advisors');
    }
}
