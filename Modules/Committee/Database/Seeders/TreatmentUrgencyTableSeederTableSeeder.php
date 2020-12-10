<?php

namespace Modules\Committee\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Committee\Entities\TreatmentUrgency;

class TreatmentUrgencyTableSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::table(TreatmentUrgency::table())->truncate();
        $urgency = [
            [
                'name' => 'عادي',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'عاجل',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'عاجل جدا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'حالا',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];
        TreatmentUrgency::insert($urgency);
    }
}
