<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupportTicketDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_ticket_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('ticket_id')->nullable();
            $table->string('name');
            $table->string('path');
            $table->unsignedBigInteger('size');
            $table->string('description')->nullable();
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
        Schema::dropIfExists('support_ticket_documents');
    }
}
