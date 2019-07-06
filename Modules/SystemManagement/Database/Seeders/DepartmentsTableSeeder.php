<?php

namespace Modules\SystemManagement\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\SystemManagement\Entities\Department;
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
            'parent_id' => 0, 'name' => 'هيئات', 'type' => '1', 'key' => 'staff', 'can_deleted' => false, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        $BodyExpertsID = Department::create([
            'parent_id' => $bodiesId, 'name' => 'هيئة￼￼￼ الخبراء', 'type' => '2', 'key' => 'staff_experts', 'can_deleted' => false, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        // Departments
        Department::create([
            'parent_id' => $BodyExpertsID, 'name' => 'إدارة تقنية المعلومات', 'key' => 'it_department', 'type' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        Department::create([
            'parent_id' => $BodyExpertsID, 'name' => 'مكتب معالي الرئيس - المستشار','key' => 'advisor', 'type' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        Department::create([
            'parent_id' => $BodyExpertsID, 'name' => 'مدير مكاتب المستشارين','key' => 'director_of_consultants_offices', 'type' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        Department::create([
            'parent_id' => $BodyExpertsID, 'name' => 'السكرتير', 'key' => 'secretary', 'type' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        Department::create([
            'parent_id' => $BodyExpertsID, 'name' => 'مدير المحافظ', 'key' => 'portfolio_Manager', 'type' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        Department::create([
            'parent_id' => $BodyExpertsID, 'name' => 'الدعم التقني', 'key' => 'technical_support', 'type' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        $magelsId = Department::create([
            'parent_id' => 0, 'name' => 'مجالس', 'type' => '1', 'key' => 'boards', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        Department::create([
            'parent_id' => $BodyExpertsID, 'name' => 'منسق', 'key' => 'coordinator', 'type' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

        $deanship = Department::create([
            'parent_id' => $bodiesId, 'name' => 'هيئة العمادات', 'type' => '2', 'key' => 'staff_deanship', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ])->id;

        Department::create([
            'parent_id' => $deanship, 'name' => 'العميد', 'key' => 'deanship_manager', 'type' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
        ]);

    }
}
