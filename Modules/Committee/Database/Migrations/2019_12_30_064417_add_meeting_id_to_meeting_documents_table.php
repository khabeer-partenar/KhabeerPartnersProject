<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMeetingIdToMeetingDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meeting_documents', function (Blueprint $table) {
            $table->unsignedBigInteger('committee_id')->after('meeting_id');
            $table->unsignedBigInteger('user_id')->after('committee_id');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('committee_id')
                ->references('id')
                ->on('committees')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meeting_documents', function (Blueprint $table) {
            $table->dropForeign('khabeer_meeting_documents_committee_id_foreign');
            $table->dropForeign('khabeer_meeting_documents_user_id_foreign');
            $table->dropColumn('committee_id');
        });
    }
}
