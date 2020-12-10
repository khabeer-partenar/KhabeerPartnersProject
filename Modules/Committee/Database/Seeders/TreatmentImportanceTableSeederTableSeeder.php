<?php

namespace Modules\Committee\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Committee\Entities\TreatmentImportance;

class TreatmentImportanceTableSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::table(TreatmentImportance::table())->truncate();
        $importance = [
            [
                'name' => 'غير سري',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'سري',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'سري للغاية',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'غير قابل للتداول',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];
        TreatmentImportance::insert($importance);
    }
}
