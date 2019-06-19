<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Users\Entities\Department;
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
        
        DB::table(Department::table())->truncate();

        $bodiesId = Department::create([
            'parent_id' => 0, 'name' => 'هيئات', 'type' => '1', 'key' => 'staff', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        $BodyExpertsID = Department::create([
            'parent_id' => $bodiesId, 'name' => 'هيئة￼￼￼ الخبراء', 'type' => '1', 'key' => 'staff_experts', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        // Departments
        Department::create([
            'parent_id' => $BodyExpertsID, 'name' => 'إدارة تقنية المعلومات', 'key' => 'it_department', 'type' => '2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        Department::create([
            'parent_id' => $BodyExpertsID, 'name' => 'مكتب معالي الرئيس - المستشار','key' => 'advisor', 'type' => '2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        Department::create([
            'parent_id' => $BodyExpertsID, 'name' => 'مدير مكاتب المستشارين','key' => 'director_of_consultants_offices', 'type' => '2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        Department::create([
            'parent_id' => $BodyExpertsID, 'name' => 'السكرتير', 'key' => 'secretary', 'type' => '2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        Department::create([
            'parent_id' => $BodyExpertsID, 'name' => 'مدير المحافظ', 'key' => 'portfolio_Manager', 'type' => '2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        Department::create([
            'parent_id' => $BodyExpertsID, 'name' => 'الدعم التقني', 'key' => 'technical_support', 'type' => '2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        $magelsId = Department::create([
            'parent_id' => 0, 'name' => 'مجالس', 'type' => '1', 'key' => 'boards', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        Department::create([
            'parent_id' => $BodyExpertsID, 'name' => 'منسق', 'key' => 'coordinator', 'type' => '2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

    }
}
