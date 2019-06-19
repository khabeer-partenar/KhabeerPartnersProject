<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Core\Entities\Department;
use Carbon\Carbon;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('departments')->truncate();

        $bodiesId = Department::create([
            'parent_id' => 0, 'name' => 'هيئات', 'type' => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        $BodyExpertsID = Department::create([
            'parent_id' => $bodiesId, 'name' => 'هيئة￼￼￼ الخبراء', 'type' => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        // Departments
        Department::create([
            'parent_id' => $BodyExpertsID, 'name' => 'إدارة تقنية المعلومات', 'type' => '2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        Department::create([
            'parent_id' => $BodyExpertsID, 'name' => 'مكتب معالي الرئيس - المستشار', 'type' => '2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        Department::create([
            'parent_id' => $BodyExpertsID, 'name' => 'مدير مكاتب المستشارين', 'type' => '2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        Department::create([
            'parent_id' => $BodyExpertsID, 'name' => 'السكرتير', 'type' => '2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        Department::create([
            'parent_id' => $BodyExpertsID, 'name' => 'مدير المحافظ', 'type' => '2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        Department::create([
            'parent_id' => $BodyExpertsID, 'name' => 'الدعم التقني', 'type' => '2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);
    }
}
