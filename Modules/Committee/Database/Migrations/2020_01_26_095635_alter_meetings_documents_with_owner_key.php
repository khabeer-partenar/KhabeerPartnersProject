<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMeetingsDocumentsWithOwnerKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meeting_documents', function (Blueprint $table) {
            $table->boolean('owner')->default(0)->after('id')->comment('True if Secretary or Advisor');
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
            $table->dropColumn('owner');
        });
    }
}
