<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCommitteesTableDropUnusedCols extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('committees', function (Blueprint $table) {
            $table->dropColumn('outgoing_number');
            $table->dropColumn('outgoing_at');
            $table->dropColumn('destination_id');
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
            $table->string('outgoing_number');
            $table->timestamp('outgoing_at')->nullable();
            $table->integer('destination_id'); // Departments Table -> Type = 2
        });
    }
}
