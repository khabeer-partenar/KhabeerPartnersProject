<?php

namespace Modules\Committee\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Core\Entities\App;
use Modules\Core\Entities\Group;
use Modules\Users\Entities\Coordinator;
use Modules\Users\Entities\Delegate;
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
        $basicApps = [
            // Committee
            'Modules\Committee\Http\Controllers',
            'Modules\Committee\Http\Controllers\CommitteeController@index',
            'Modules\Committee\Http\Controllers\CommitteeController@show',
            'Modules\Committee\Http\Controllers\CommitteeDocumentController@download',
            // Meeting
            'Modules\Committee\Http\Controllers\CommitteeMeetingController@index',
            'Modules\Committee\Http\Controllers\CommitteeMeetingController@show',
            'Modules\Committee\Http\Controllers\MeetingController@index',
        ];
        $coordinatorApps = [
            'Modules\Committee\Http\Controllers\CommitteeController@sendNomination',
            'Modules\Committee\Http\Controllers\CommitteeController@getDelegatesWithDetails',
            'Modules\Committee\Http\Controllers\CommitteeController@getNominationDepartmentsWithRef',
        ];
        $secretaryAndAdvisorApps = [
            // Committee
            'Modules\Committee\Http\Controllers\CommitteeController@create',
            'Modules\Committee\Http\Controllers\CommitteeController@store',
            'Modules\Committee\Http\Controllers\CommitteeController@edit',
            'Modules\Committee\Http\Controllers\CommitteeController@update',
            'Modules\Committee\Http\Controllers\CommitteeController@destroy',
            'Modules\Committee\Http\Controllers\CommitteeDocumentController@upload',
            'Modules\Committee\Http\Controllers\CommitteeDocumentController@delete',
            // Meeting
            'Modules\Committee\Http\Controllers\CommitteeMeetingController@create',
            'Modules\Committee\Http\Controllers\CommitteeMeetingController@store',
            'Modules\Committee\Http\Controllers\CommitteeMeetingController@edit',
            'Modules\Committee\Http\Controllers\CommitteeMeetingController@update',
            'Modules\Committee\Http\Controllers\CommitteeMeetingController@destroy',
            // Attendance
            'Modules\Committee\Http\Controllers\MeetingAttendanceController@create',
            'Modules\Committee\Http\Controllers\MeetingAttendanceController@store',
            // Multimedia
            'Modules\Committee\Http\Controllers\CommitteeMultimediaController@index',
            'Modules\Committee\Http\Controllers\MeetingMultimediaController@index',
        ];
        $delegatesApps = [
            // Meeting
            'Modules\Committee\Http\Controllers\DelegateMeetingController@show',
            'Modules\Committee\Http\Controllers\DelegateMeetingController@update',
            // Documents
            'Modules\Committee\Http\Controllers\DelegateDocumentsController@store',
            'Modules\Committee\Http\Controllers\DelegateDocumentsController@destroy',
            'Modules\Committee\Http\Controllers\DelegateDocumentsController@show',
        ];
        $advisorApps = [
            'Modules\Committee\Http\Controllers\CommitteeController@approve',
        ];
        // Apps Ids
        $basicIds = App::whereIn('resource_name', $basicResources)->pluck('id');
        $commId = App::whereIn('resource_name', $basicApps)->pluck('id');
        $coordaintorApps = App::whereIn('resource_name', $coordinatorApps)->pluck('id');
        $highLevelPermissions = App::whereIn('resource_name', $secretaryAndAdvisorApps)->pluck('id');
        // Coordinator Permissions
        $coordinatorGroup = Group::where('key', Coordinator::MAIN_CO_JOB)->first();
        foreach($commId as $appId){
            $coordinatorGroup->permissions()->create([
                'app_id' => $appId
            ]);
        }
        foreach($coordaintorApps as $appId){
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
        foreach($highLevelPermissions as $appId){
            $secretaryGroup->permissions()->create([
                'app_id' => $appId
            ]);
        }
        // Advisor
        $advsiorGroup = Group::where('key', Employee::ADVISOR)->first();
        foreach($basicIds as $appId){
            $advsiorGroup->permissions()->create([
                'app_id' => $appId
            ]);
        }
        foreach($commId as $appId){
            $advsiorGroup->permissions()->create([
                'app_id' => $appId
            ]);
        }
        foreach($highLevelPermissions as $appId){
            $advsiorGroup->permissions()->create([
                'app_id' => $appId
            ]);
        }
        foreach($advisorApps as $appId){
            $advsiorGroup->permissions()->create([
                'app_id' => $appId
            ]);
        }
        // Delegate
        $delegate = Group::where('key', Delegate::JOB)->first();
        foreach($basicIds as $appId){
            $delegate->permissions()->create([
                'app_id' => $appId
            ]);
        }
        foreach($commId as $appId){
            $delegate->permissions()->create([
                'app_id' => $appId
            ]);
        }
        foreach($delegatesApps as $appId){
            $delegate->permissions()->create([
                'app_id' => $appId
            ]);
        }
    }
}
