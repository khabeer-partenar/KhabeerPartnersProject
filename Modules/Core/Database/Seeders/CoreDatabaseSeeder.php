<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Database\Seeders\CoreAppsTableSeeder;
use Modules\Core\Database\Seeders\DefaultGroupsTableSeeder;
use Modules\Core\Database\Seeders\DepartmentsTableSeeder;

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
        $this->call(DepartmentsTableSeeder::class);
    }
}
