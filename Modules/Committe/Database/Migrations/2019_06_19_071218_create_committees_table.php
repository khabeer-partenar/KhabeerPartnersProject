<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommitteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('committees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('treat_num');
            $table->date('treat_date');
            $table->integer('treat_destination_id')->unique();
            $table->integer('treat_type_id')->unique();
            $table->integer('treat_speed_id')->unique();
            $table->integer('treat_importance_id')->unique();
            $table->integer('study_source_id')->unique();
            $table->string('outgoing_number');
            $table->date('outgoing_date');
            $table->integer('recommend_destination_id')->unique();
            $table->string('recommend_number');
            $table->date('recommend_date');
            $table->string('committee_subject');
            $table->string('committee_start_date');
            $table->string('committee_tasks');
            $table->integer('committee_president_id')->unique();
            $table->integer('committee_consultant_id')->unique();
            $table->integer('members_number');
            $table->integer('participant_destination_id')->unique();
            $table->string('participant_standards');
            $table->string('participant_consulants');
            $table->string('doc_description');
            $table->string('doc');
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
        Schema::dropIfExists('committees');
    }
}
