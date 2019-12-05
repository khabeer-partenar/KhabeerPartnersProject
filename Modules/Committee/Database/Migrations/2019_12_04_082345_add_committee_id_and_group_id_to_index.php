<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommitteeIdAndGroupIdToIndex extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('committee_group_status', function (Blueprint $table) {
            $table->index(['committee_id', 'group_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('committee_group_status', function (Blueprint $table) {
            $table->dropIndex(['committee_id', 'group_id']);
        });
    }
}
