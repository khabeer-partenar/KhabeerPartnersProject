<?php

namespace Modules\Committee\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Committee\Entities\MeetingType;

class MeetingTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table(MeetingType::table())->truncate();
        $arr = [
            [
                'name' => 'أولي',
                'active' => true,
                'color' => '#009247',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'استكمالي',
                'active' => true,
                'color' => '#d6a329',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'توقيع',
                'active' => true,
                'color' => '#337ab7',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];
        MeetingType::insert($arr);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
