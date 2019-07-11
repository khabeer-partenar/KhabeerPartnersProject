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

            $table->string('treatment_number');
            $table->timestamp('treatment_time')->nullable();
            $table->string('treatment_time_hijri');
            $table->integer('destination_id'); // Departments Table -> Type = 2
            $table->integer('treatment_type_id');
            $table->integer('treatment_urgency_id');
            $table->integer('treatment_importance_id');

            $table->integer('source_of_study_id'); // Departments Table
            $table->string('outgoing_number');
            $table->timestamp('outgoing_at')->nullable();
            $table->string('outgoing_at_hijri');

            $table->string('recommendation_number');
            $table->integer('recommended_by_id'); // Departments Table
            $table->string('recommended_at');

            $table->string('subject');
            $table->timestamp('first_meeting_at')->nullable();
            $table->string('first_meeting_at_hijri');
            $table->text('tasks')->nullable();
            $table->integer('president_id')->nullable();
            $table->integer('advisor_id');
            $table->integer('members_count')->default(0);
            $table->timestamps();
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
