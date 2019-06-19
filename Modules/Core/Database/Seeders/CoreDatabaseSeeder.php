<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Database\Seeders\CoreAppsTableSeeder;
use Modules\Core\Database\Seeders\DefaultGroupsTableSeeder;
<<<<<<< HEAD
use Modules\Core\Database\Seeders\DepartmentsTableSeeder;
=======
>>>>>>> origin/master

class CoreDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(CoreAppsTableSeeder::class);
        $this->call(DefaultGroupsTableSeeder::class);
<<<<<<< HEAD
        $this->call(DepartmentsTableSeeder::class);
=======
>>>>>>> origin/master
    }
}
