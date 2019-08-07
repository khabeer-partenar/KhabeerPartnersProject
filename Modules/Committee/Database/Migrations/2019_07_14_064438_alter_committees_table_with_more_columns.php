<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCommitteesTableWithMoreColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('committees', function (Blueprint $table) {
            $table->string('resource_staff_number')->after('id');
            $table->timestamp('resource_at')->nullable()->after('resource_staff_number');
            $table->string('resource_at_hijri')->after('resource_at');
            $table->integer('resource_by')->after('resource_at_hijri'); // Department
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
            $table->dropColumn('resource_staff_number');
            $table->dropColumn('resource_at');
            $table->dropColumn('resource_at_hijri');
            $table->dropColumn('resource_by');
        });
    }
}
