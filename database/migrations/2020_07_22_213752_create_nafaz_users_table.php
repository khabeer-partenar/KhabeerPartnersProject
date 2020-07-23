<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNafazUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nafaz_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('national_id')->unique();
            $table->string('ar_family_name');
            $table->string('en_family_name');
            $table->string('ar_father_name');
            $table->string('en_father_name');
            $table->string('ar_name');
            $table->string('en_name');
            $table->string('ar_first_name');
            $table->string('en_first_name');
            $table->string('ar_grandfather_name');
            $table->string('en_grandfather_name');
            $table->string('ar_nationality');
            $table->string('nationality');
            $table->integer('nationality_code');
            $table->string('gender');
            $table->date('card_issue_date');
            $table->date('card_issue_hijri');
            $table->date('iqama_expiry_date');
            $table->date('iqama_expiry_hijri');
            $table->date('id_expiry_date');
            $table->date('id_expiry_hijri');
            $table->date('birth_date');
            $table->date('birth_hijri');
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
        Schema::dropIfExists('nafaz_users');
    }
}
