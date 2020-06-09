<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Users\Entities\Coordinator;
use Modules\Users\Entities\Delegate;
use Modules\Users\Entities\User;

class DelegatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $delegates = [
            [
                'name' => 'أحمد الدسوقي', 'national_id' => '10001000',
                'email' => 'mail-10001000@mu.gov.sa', 'phone_number' => '0563108765',
                'main_department_id' => '13', 'parent_department_id' => '16', 'user_type' => Delegate::TYPE,
                'title' => 'مندوب', 'job_title' => 'مطور ويب', 'job_role_id' => '7'
            ],
            [
                'name' => 'محمد إبراهيم', 'national_id' => '1000010025', 'phone_number' => '0563108768', 'direct_department' => '4',
                'email' => 'mail-1000010025@mu.gov.sa',
                'main_department_id' => '1', 'parent_department_id' => '14', 'user_type' => Delegate::TYPE,
                'title' => 'مندوب', 'job_title' => 'مطور', 'job_role_id' => '7'
            ],
        ];
        for($i = 0; $i < count($delegates); $i++) {
            $delegate = User::create($delegates[$i]);
            $delegate->groups()->attach($delegates[$i]['job_role_id']);
        }
    }
}
