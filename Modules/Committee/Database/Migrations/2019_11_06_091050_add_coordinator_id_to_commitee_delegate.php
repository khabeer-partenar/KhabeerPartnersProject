<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCoordinatorIdToCommiteeDelegate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('committee_delegate', function (Blueprint $table) {
            $table->integer('coordinator_id')->after('nominated_department_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('committee_delegate', function($table) {
            $table->dropColumn('coordinator_id');
        });
    }
}
