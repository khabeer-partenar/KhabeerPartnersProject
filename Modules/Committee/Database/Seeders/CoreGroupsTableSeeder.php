<?php

namespace Modules\Committee\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Core\Entities\App;
use Modules\Core\Entities\Group;
use Modules\Users\Entities\Coordinator;
use Modules\Users\Entities\Employee;
use Modules\Users\Entities\User;

class CoreGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $basicResources = [
            'Modules',
        ];
        $committeesResources = [
            'Modules\Committee\Http\Controllers',
            'Modules\Committee\Http\Controllers\CommitteeController@index',
            'Modules\Committee\Http\Controllers\CommitteeController@create',
            'Modules\Committee\Http\Controllers\CommitteeController@store',
            'Modules\Committee\Http\Controllers\CommitteeController@show',
            'Modules\Committee\Http\Controllers\CommitteeController@edit',
            'Modules\Committee\Http\Controllers\CommitteeController@update',
            'Modules\Committee\Http\Controllers\CommitteeController@destroy',
            'Modules\Committee\Http\Controllers\CommitteeDocumentController@upload',
            'Modules\Committee\Http\Controllers\CommitteeDocumentController@delete',
            'Modules\Committee\Http\Controllers\CommitteeDocumentController@download'
        ];
        // Apps Ids
        $basicIds = App::whereIn('resource_name', $basicResources)->pluck('id');
        $commId = App::whereIn('resource_name', $committeesResources)->pluck('id');
        // Coordinator Permissions
        $coordinatorGroup = Group::where('key', Coordinator::MAIN_CO_JOB)->first();
        foreach($commId as $appId){
            $coordinatorGroup->permissions()->create([
                'app_id' => $appId
            ]);
        }
        // Sec Permissions
        $secretaryGroup = Group::where('key', Employee::SECRETARY)->first();
        foreach($basicIds as $appId){
            $secretaryGroup->permissions()->create([
                'app_id' => $appId
            ]);
        }
        foreach($commId as $appId){
            $secretaryGroup->permissions()->create([
                'app_id' => $appId
            ]);
        }
    }
}
