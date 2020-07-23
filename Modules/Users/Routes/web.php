<?php

Route::group(['middleware' => 'guest'], function()
{
    Route::get('/login', 'AuthController@showLoginForm')->name('showLoginForm');
    Route::post('/login', 'AuthController@login')->name('login');
});

Route::group(['middleware' => 'auth', 'still.loggedIn'], function()
{

    Route::prefix('users')->group(function(){

        // Coordinator Controller
        Route::resource('/coordinators', 'CoordinatorController')->middleware('coordinator.can');

        // Delegate
        Route::resource('/delegates', 'DelegateController')->middleware('read.delegate');

        Route::get('/delegates/deleteUser/{delegate_id}/{committee_id}/{department_id}/{reason?}', 'DelegateController@removeFromCommitte')->name('delegate.remove.from.committee');

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

        // Account
        Route::prefix('account')->group(function(){

            Route::get('/edit', 'AccountController@edit')->name('account.edit');
            Route::put('/edit', 'AccountController@update')->name('account.update');
            Route::get('/logout', 'AccountController@logout')->name('account.logout');


            Route::get('/support/create', 'SupportController@create')->name('support.create');
            Route::post('/support/create', 'SupportController@store')->name('support.store');
            Route::post('/support/upload-attachments', 'SupportController@uploadAttachments')->name('support.upload-attachments');
            Route::delete('/support/{attachment}/delete-attachments', 'SupportController@deleteAttachments')->name('support.delete-attachments');
        });


    });
});
