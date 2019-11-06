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
            'parent_id' => 0, 'name' => 'هيئات', 'type' => '1', 'key' => 'staff', 'can_deleted' => false, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
            'is_reference' => 1
        ])->id;

        $BodyExpertsID = Department::create([
            'parent_id' => $bodiesId, 'name' => 'هيئة الخبرا', 'type' => '2', 'key' => 'staff_experts', 'can_deleted' => false, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
            'is_reference' => 1
        ])->id;

        // Departments
        Department::create([
            'parent_id' => $BodyExpertsID, 'name' => 'إدارة تقنية المعلومات', 'key' => 'it_department', 'type' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
            'is_reference' => 1
        ]);

        Department::create([
            'parent_id' => $BodyExpertsID, 'name' => 'مكتب معالي الرئيس - المستشار','key' => 'advisor', 'type' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
            'is_reference' => 1
        ]);

        Department::create([
            'parent_id' => $BodyExpertsID, 'name' => 'مدير مكاتب المستشارين','key' => 'director_of_consultants_offices', 'type' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
            'is_reference' => 1
        ]);

        Department::create([
            'parent_id' => $BodyExpertsID, 'name' => 'السكرتير', 'key' => 'secretary', 'type' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
            'is_reference' => 1
        ]);

        Department::create([
            'parent_id' => $BodyExpertsID, 'name' => 'مدير المحافظ', 'key' => 'portfolio_Manager', 'type' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
            'is_reference' => 1
        ]);

        Department::create([
            'parent_id' => $BodyExpertsID, 'name' => 'الدعم التقني', 'key' => 'technical_support', 'type' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
            'is_reference' => 1
        ]);

        $magelsId = Department::create([
            'parent_id' => 0, 'name' => 'مجالس', 'type' => '1', 'key' => 'boards', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
            'is_reference' => 1
        ])->id;

        Department::create([
            'parent_id' => $BodyExpertsID, 'name' => 'منسق', 'key' => 'coordinator', 'type' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
            'is_reference' => 1
        ]);

        $deanship = Department::create([
            'parent_id' => $bodiesId, 'name' => 'هيئة العمادات', 'type' => '2', 'key' => 'staff_deanship', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
            'is_reference' => 1
        ])->id;

        Department::create([
            'parent_id' => $deanship, 'name' => 'العميد', 'key' => 'deanship_manager', 'type' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
            'is_reference' => 1
        ]);


        $GovId = Department::create([
            'parent_id' => 0, 'name' => 'وزارات', 'type' => '1', 'key' => 'ministries', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
            'is_reference' => 1
        ])->id;

        $Gov1 = Department::create([
            'parent_id' => $GovId, 'name' => 'وزارة الإعلام', 'type' => '2', 'key' => 'Government_1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
            'is_reference' => 1
        ])->id;

        $Gov2 = Department::create([
            'parent_id' => $GovId, 'name' => 'وزارة الثقافة', 'type' => '2', 'key' => 'Government_2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
            'is_reference' => 1
        ])->id;

        $Gov3 = Department::create([
            'parent_id' => $GovId, 'name' => 'وزارة الصحة', 'type' => '2', 'key' => 'Government_3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
            'is_reference' => 1
        ])->id;


        $mgls_sehaa = Department::create([
            'parent_id' => $magelsId, 'name' => 'مجلس الضمان الصحي', 'key' => 'magls-seha', 'type' => '2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
            'reference_id' => $Gov3
        ])->id;

        Department::create([
            'parent_id' => $mgls_sehaa, 'name' => 'مستشار صحة', 'key' => 'Health_advisor', 'type' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
            'is_reference' => 1
        ]);

    }
}
