<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use Modules\Committee\Entities\Committee;
use Modules\Core\Entities\Group;
use Modules\Core\Entities\Status;
use Modules\SystemManagement\Entities\Department;
use Modules\Users\Entities\Coordinator;
use Modules\Users\Entities\Employee;

Route::group(['middleware' => 'guest'], function()
{
    Route::get('/login', 'AuthController@showLoginForm')->name('showLoginForm');
    Route::post('/login', 'AuthController@login')->name('login');
});

Route::group(['middleware' => 'auth'], function()
{
    // Auth Controller
    Route::get('/logout', 'AuthController@logout')->name('logout');



    Route::prefix('users')->group(function(){

        Route::get('test',function ()
        {
            $committee = Committee::where('id',8)->first();
            $group_id = auth()->user()->job_role_id;
            $committee->groupsStatuses()->syncWithoutDetaching([$group_id => ['status' => Status::NOMINATIONS_DONE]]);

            dd('done');
            //$committee->groupsStatuses()->detach();

        });
        // Coordinator Controller
        Route::resource('/coordinators', 'CoordinatorController')->middleware('coordinator.can');

        // Delegate

        Route::get('/delegates/deleteUser/{delegate_id}/{committee_id}/{department_id}/{reason?}', 'DelegateController@removeFromCommitte')->name('delegate.remove.from.committee');
        Route::resource('/delegates','DelegateController');

        //Route::get('/delegates/deleteUser/{delegate_id}/{committee_id/{department_id}', 'DelegateController@removeFromCommitte')->name('delegate.remove.from.committee');

        Route::post('/delegates/add_delegate','DelegateController@addDelegatesToCommittee')->name('delegates.add_delegates');
        Route::get('/delegates/DepartmentDelegatesNotInCommittee/{department_id}/{committee_id}','DelegateController@getDepartmentDelegatesNotInCommittee');
        Route::get('/delegates/getMainCoordinatorNominatedDelegates/{committee_id}','DelegateController@checkIfMainCoordinatorNominateDelegates');

        // Assign Committe Controller
        Route::get('/employees/assign-committees/search/{groupID}/{columnType}', 'AssignCommitteController@search')->name('employees.assign_committees.search');
        Route::get('/employees/assign-committees', 'AssignCommitteController@index')->name('employees.assign_committees.index');
        Route::get('/employees/employees/{employee}/edit/assign-committees', 'AssignCommitteController@edit')->name('employees.assign_committees.edit');
        Route::put('/employees/employees/{employee}/edit/assign-committees', 'AssignCommitteController@update')->name('employees.assign_committees.update');

        // Employee Controller
        Route::get('/employees/search-by-name', 'EmployeeController@searchByName')->name('employees.search_by_name');
        Route::get('/employees/{employee}/upgrate-to-super-admin', 'EmployeeController@upgrateToSuperAdmin')->name('employees.upgrate_to_super_admin');
        Route::resource('/employees', 'EmployeeController');

        // User Controller 
        Route::get('/search', 'UserController@search')->name('users.search');
    });
});
