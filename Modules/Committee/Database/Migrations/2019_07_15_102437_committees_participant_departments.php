<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CommitteesParticipantDepartments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('committees_participant_departments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('committee_id');
            $table->integer('department_id');
            $table->integer('reference_department')->nullable();
            $table->string('nomination_criteria')->nullable();
            $table->boolean('has_nominations')->default(0);
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
        Schema::dropIfExists('committees_participant_departments');
    }
}
