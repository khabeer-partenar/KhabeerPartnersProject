<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReasonOfDeletionToCommitteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('committees', function (Blueprint $table) {
            $table->string('reason_of_deletion', 300)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('committees', function (Blueprint $table) {
            $table->dropColumn('reason_of_deletion');
        });
    }
}
