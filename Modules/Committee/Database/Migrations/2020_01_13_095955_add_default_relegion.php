<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Committee\Entities\Religion;
use Carbon\Carbon;

class AddDefaultRelegion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Religion::create(
            ['name' => 'مسلم', 'name_en' => 'muslim', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        Religion::create(
            ['name' => 'غير مسلم', 'name_en' => 'christian', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('', function (Blueprint $table) {

        // });
    }
}
