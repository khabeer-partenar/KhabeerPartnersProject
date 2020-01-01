<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommitteeView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('committee_view', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('committee_id');
            $table->integer('user_id');
            $table->boolean('view')->default(0);
            $table->timestamps();
            $table->index(['committee_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('committee_view');
    }
}
