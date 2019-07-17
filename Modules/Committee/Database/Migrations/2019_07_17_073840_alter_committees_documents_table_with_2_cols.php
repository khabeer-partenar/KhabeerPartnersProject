<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCommitteesDocumentsTableWith2Cols extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('committee_documents', function (Blueprint $table) {
            $table->integer('user_id')->after('path');
            $table->integer('committee_id')->after('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('committee_documents', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('committee_id');
        });
    }
}
