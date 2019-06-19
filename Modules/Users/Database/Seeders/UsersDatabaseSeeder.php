<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Users\Database\Seeders\FakeUsersTableSeeder;
use Modules\Users\Database\Seeders\DepartmentsTableSeeder;

class UsersDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        
        $this->call(FakeUsersTableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
    }
}
