<?php


namespace Modules\Core\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Core\Entities\City;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::table(City::table())->truncate();

        $cities = [
            [
                'name' => 'الرياض',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'جدة',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        City::insert($cities);
    }
}