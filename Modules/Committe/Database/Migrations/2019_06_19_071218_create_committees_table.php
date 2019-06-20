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
            $table->string('outgoing_number');
            $table->date('outgoing_date');
            $table->string('recommend_number');
            $table->date('recommend_date');
            $table->string('committee_subject');
            $table->date('committee_start_date');
            $table->string('committee_tasks');
            $table->integer('members_number');
            $table->string('participant_standards');
            $table->string('doc_description');
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
