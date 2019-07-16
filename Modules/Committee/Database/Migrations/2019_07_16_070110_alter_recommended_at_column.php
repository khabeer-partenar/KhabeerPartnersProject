<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRecommendedAtColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('committees', function (Blueprint $table) {
            $table->dropColumn('recommended_at');
        });
        Schema::table('committees', function (Blueprint $table) {
            $table->timestamp('recommended_at')->nullable()->after('recommended_by_id');
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
            $table->dropColumn('recommended_at')->nullable();
        });
        Schema::table('committees', function (Blueprint $table) {
            $table->string('recommended_at');
        });
    }
}
