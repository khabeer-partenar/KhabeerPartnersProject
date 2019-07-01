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

Route::group(['middleware' => 'guest'], function()
{
    Route::get('/login', 'AuthController@showLoginForm')->name('showLoginForm');
    Route::post('/login', 'AuthController@login')->name('login');
});

Route::group(['middleware' => 'auth'], function()
{
    // Auth Controller
    Route::get('/logout', 'AuthController@logout')->name('logout');


    // Departments Controller
    Route::get('/departments', 'DepartmentsController@loadDepartmentsByParentId')->name('departments.children');

    Route::prefix('users')->group(function(){
        // Coordinator Controller
        Route::post('/coordinators/store-by-co', 'CoordinatorController@storeByCoordinator')->name('coordinators.store_by_co');
        Route::put('/coordinators/{coordinator}/update-by-co', 'CoordinatorController@updateByCoordinator')->name('coordinators.update_by_co');
        Route::resource('/coordinators', 'CoordinatorController'); // ->middleware('coordinator.can');

        // Employee Controller
        Route::get('/employees/search', 'EmployeeController@search')->name('employees.search');
        Route::get('/employees/search-by-name', 'EmployeeController@searchByName')->name('employees.searchByName');
        Route::get('/employees/{employee}/destroy', 'EmployeeController@destroyConfirmation')->name('employees.destroy-confirmation');
        Route::get('/employees/{employee}/secretaries', 'EmployeeController@secretaries')->name('employees.secretaries');
        Route::get('/employees/{employee}/edit/secretaries', 'EmployeeController@editSecretaries')->name('employees.edit_secretaries');
        Route::put('/employees/{employee}/edit/secretaries', 'EmployeeController@updateSecretaries')->name('employees.update_secretaries');
        Route::get('/employees/search-by-name', 'EmployeeController@searchByName')->name('employees.search_by_name');
        Route::get('/employees/{employee}upgrate-to-super-admin', 'EmployeeController@upgrateToSuperAdmin')->name('employees.upgrate_to_super_admin');
        Route::resource('/employees', 'EmployeeController');

        // User Controller 
        Route::get('/search', 'UserController@search')->name('users.search');
    });
});
