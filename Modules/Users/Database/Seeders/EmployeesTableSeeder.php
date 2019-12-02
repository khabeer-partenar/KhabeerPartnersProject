<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Users\Entities\User;
use Carbon\Carbon;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        
        DB::table('users_advisors_secretaries')->truncate();
        DB::table('committee_delegate')->truncate();
        DB::table(User::table())->truncate();

        $usersData = [

            [
                'name' => 'Abdullah', 'national_id' => '1000000001', 'email' => 'mail-1000000001@mu.gov.sa', 'phone_number' => '0583748000',
                'main_department_id' => '1', 'parent_department_id' => '2',
                'direct_department_id' => 3, 'is_super_admin' => 1, 'job_role_id' => 1,
                'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
            ],

            [
                'name' => 'علي عبدالله الهجرس', 'national_id' => '1003020797', 'email' => 'mail-1003020797@mu.gov.sa', 'phone_number' => '0505131000',
                'main_department_id' => '1', 'parent_department_id' => '2',
                'direct_department_id' => 3, 'is_super_admin' => 0, 'job_role_id' => 1,
                'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
            ],

            [
                'name' => 'ضيف الله ذويبان العازمي', 'national_id' => '1058079540', 'email' => 'mail-1058079540@mu.gov.sa', 'phone_number' => '0556639000',
                'main_department_id' => '1', 'parent_department_id' => '2',
                'direct_department_id' => 3, 'is_super_admin' => 0, 'job_role_id' => 2,
                'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
            ],

            [
                'name' => 'لؤي صالح العدينات', 'national_id' => '2299727657', 'email' => 'mail-2299727657@mu.gov.sa', 'phone_number' => '0505696000',
                'main_department_id' => '1', 'parent_department_id' => '2',
                'direct_department_id' => 3, 'is_super_admin' => 0, 'job_role_id' => 3,
                'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
            ],

            [
                'name' => 'د.عمر محمد المتيهي', 'national_id' => '1033453489', 'email' => 'mail-1033453489@mu.gov.sa', 'phone_number' => '0535040000',
                'main_department_id' => '1', 'parent_department_id' => '2',
                'direct_department_id' => 3, 'is_super_admin' => 0, 'job_role_id' => 4,
                'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
            ],

            [
                'name' => 'زاهد حفيظ محمد حفيظ', 'national_id' => '2297990943', 'email' => 'mail-2297990943@mu.gov.sa', 'phone_number' => '0555419000',
                'main_department_id' => '1', 'parent_department_id' => '2',
                'direct_department_id' => 3, 'is_super_admin' => 0, 'job_role_id' => 2,
                'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
            ],

            [
                'name' => 'مساعد صالح الخنيني', 'national_id' => '1015608654', 'email' => 'mail-1015608654@mu.gov.sa', 'phone_number' => '0505122000',
                'main_department_id' => '1', 'parent_department_id' => '2',
                'direct_department_id' => 3, 'is_super_admin' => 0, 'job_role_id' => 6,
                'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
            ],

            [
                'name' => 'أحمد بن صالح الصالح', 'national_id' => '1022305138', 'email' => 'mail-1022305138@mu.gov.sa', 'phone_number' => '0543239000',
                'main_department_id' => '1', 'parent_department_id' => '2',
                'direct_department_id' => 3, 'is_super_admin' => 0, 'job_role_id' => 7,
                'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
            ],

            [
                'name' => 'محمد عبدالهادي عبدالعزيز المطيري', 'national_id' => '1057796813', 'email' => 'mail-1057796813@mu.gov.sa', 'phone_number' => '0558557000',
                'main_department_id' => '1', 'parent_department_id' => '2',
                'direct_department_id' => 3, 'is_super_admin' => 0, 'job_role_id' => 4,
                'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
            ],

            [
                'name' => 'محمد بن سليمان حمد الثبيتي', 'national_id' => '1046079792', 'email' => 'mail-1046079792@mu.gov.sa', 'phone_number' => '0503456000',
                'main_department_id' => '1', 'parent_department_id' => '2',
                'direct_department_id' => 3, 'is_super_admin' => 0, 'job_role_id' => 2,
                'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
            ],

            [
                'name' => 'شبلان محمد السيحاني', 'national_id' => '1064525486', 'email' => 'mail-1064525486@mu.gov.sa', 'phone_number' => '0508236000',
                'main_department_id' => '1', 'parent_department_id' => '2',
                'direct_department_id' => 3, 'is_super_admin' => 0, 'job_role_id' => 15,
                'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
            ],

            [
                'name' => 'خالد عايد الرشيدي', 'national_id' => '1044659629', 'email' => 'mail-1044659629@mu.gov.sa', 'phone_number' => '0557644000',
                'main_department_id' => '1', 'parent_department_id' => '2',
                'direct_department_id' => 3, 'is_super_admin' => 0, 'job_role_id' => 10,
                'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
            ],

            [
                'name' => 'زيد بن عبدالله الرومي', 'national_id' => '1020769707', 'email' => 'mail-1020769707@mu.gov.sa', 'phone_number' => '0555122000',
                'main_department_id' => '1', 'parent_department_id' => '2',
                'direct_department_id' => 3, 'is_super_admin' => 0, 'job_role_id' => 2,
                'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
            ],

        ];


        for($i=0; $i<count($usersData); $i++) {
            $userData = User::create($usersData[$i]);
            $userData->groups()->attach($usersData[$i]['job_role_id']);
        }
    }
}
