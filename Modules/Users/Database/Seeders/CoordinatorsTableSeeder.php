<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Users\Entities\Coordinator;
use Modules\Users\Entities\User;

class CoordinatorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $coordinators = [
            [
                'name' => 'ممدوح مجدي', 'national_id' => '2468389412',
                'email' => 'mail-2468389412@mu.gov.sa', 'phone_number' => '0563108741',
                'main_department_id' => '13', 'parent_department_id' => '16', 'user_type' => Coordinator::TYPE,
                'title' => 'أستاذ', 'job_title' => 'مطور ويب', 'job_role_id' => '10'
            ],
            [
                'name' => 'محمد إبراهيم', 'national_id' => '1000000017', 'phone_number' => '0563108748', 'direct_department_id' => '4',
                'email' => 'mail-1000000017@mu.gov.sa',
                'main_department_id' => '1', 'parent_department_id' => '2', 'user_type' => Coordinator::TYPE,
                'department_reference_id' => '153124', 'title' => 'مهندس', 'job_title' => 'مطور', 'job_role_id' => '11'
            ],
            [
                'name' => 'عبدالله القديري', 'national_id' => '1000000018', 'phone_number' => '0563108749', 'direct_department_id' => '5',
                'email' => 'mail-1000000018@mu.gov.sa',
                'main_department_id' => '1', 'parent_department_id' => '2', 'user_type' => Coordinator::TYPE,
                'department_reference_id' => '123124', 'title' => 'مهندس', 'job_title' => 'مطور', 'job_role_id' => '11'
            ],
            [
                'name' => 'محمد أسامة', 'national_id' => '1000000019', 'phone_number' => '0563108750', 'direct_department_id' => '6',
                'email' => 'mail-1000000019@mu.gov.sa',
                'main_department_id' => '1', 'parent_department_id' => '2', 'user_type' => Coordinator::TYPE,
                'department_reference_id' => '123124', 'title' => 'مهندس', 'job_title' => 'مطور', 'job_role_id' => '11'
            ],
            [
                'name' => 'محمود الكبير', 'national_id' => '1000000020', 'phone_number' => '0563108751', 'direct_department_id' => '5',
                'email' => 'mail-1000000020@mu.gov.sa',
                'main_department_id' => '1', 'parent_department_id' => '2', 'user_type' => Coordinator::TYPE,
                'department_reference_id' => '123124', 'title' => 'مهندس', 'job_title' => 'مطور', 'job_role_id' => '11'
            ],
            [
                'name' => 'حسام حسام', 'national_id' => '1000000021', 'phone_number' => '0563108752', 'direct_department_id' => '6',
                'email' => 'mail-1000000021@mu.gov.sa',
                'main_department_id' => '1', 'parent_department_id' => '2', 'user_type' => Coordinator::TYPE,
                'department_reference_id' => '123124', 'title' => 'مهندس', 'job_title' => 'مطور', 'job_role_id' => '11'
            ],
            [
                'name' => 'حازم إمام', 'national_id' => '1000000022', 'phone_number' => '0563108753', 'direct_department_id' => '5',
                'email' => 'mail-1000000022@mu.gov.sa',
                'main_department_id' => '1', 'parent_department_id' => '2', 'user_type' => Coordinator::TYPE,
                'department_reference_id' => '123124', 'title' => 'مهندس', 'job_title' => 'مطور', 'job_role_id' => '11'
            ],
            [
                'name' => 'محمود كهربا', 'national_id' => '1000000012', 'phone_number' => '0563108754', 'direct_department_id' => '7',
                'email' => 'mail-1000000023@mu.gov.sa',
                'main_department_id' => '1', 'parent_department_id' => '2', 'user_type' => Coordinator::TYPE,
                'department_reference_id' => '123124', 'title' => 'مهندس', 'job_title' => 'مطور', 'job_role_id' => '11'
            ],
            [
                'name' => 'فهد المولد', 'national_id' => '1000000013', 'phone_number' => '0563108755', 'direct_department_id' => '8',
                'email' => 'mail-1000000024@mu.gov.sa',
                'main_department_id' => '1', 'parent_department_id' => '2', 'user_type' => Coordinator::TYPE,
                'department_reference_id' => '123124', 'title' => 'مهندس', 'job_title' => 'مطور', 'job_role_id' => '11'
            ],
            [
                'name' => 'البريقي', 'national_id' => '1000000014', 'phone_number' => '0563108756', 'direct_department_id' => '8',
                'email' => 'mail-1000000025@mu.gov.sa',
                'main_department_id' => '1', 'parent_department_id' => '2', 'user_type' => Coordinator::TYPE,
                'department_reference_id' => '123124', 'title' => 'مهندس', 'job_title' => 'مطور', 'job_role_id' => '11'
            ],
            [
                'name' => 'يونس بالهنده', 'national_id' => '1000000015', 'phone_number' => '0563108757', 'direct_department_id' => '12',
                'email' => 'mail-1000000026@mu.gov.sa',
                'main_department_id' => '1', 'parent_department_id' => '11', 'user_type' => Coordinator::TYPE,
                'department_reference_id' => '123124', 'title' => 'مهندس', 'job_title' => 'مطور', 'job_role_id' => '11'
            ],
            [
                'name' => 'رياض محرز', 'national_id' => '1000000016', 'phone_number' => '0563108759', 'direct_department_id' => '12',
                'email' => 'mail-1000000027@mu.gov.sa',
                'main_department_id' => '1', 'parent_department_id' => '11', 'user_type' => Coordinator::TYPE,
                'department_reference_id' => '123124', 'title' => 'مهندس', 'job_title' => 'مطور', 'job_role_id' => '11'
            ],
        ];
        for($i = 0; $i < count($coordinators); $i++) {
            $coordinator = User::create($coordinators[$i]);
            $coordinator->groups()->attach($coordinators[$i]['job_role_id']);
        }
    }
}
