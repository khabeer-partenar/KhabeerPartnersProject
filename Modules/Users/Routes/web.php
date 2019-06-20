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

    // Users Controller
    Route::get('/users/search', 'UsersController@search')->name('users.search');
    Route::get('/users/upgrate-to-super-admin/{userID}', 'UsersController@upgrateToSuperAdmin')->name('users.upgrate_to_super_admin');
    Route::get('/users/groups', 'UsersController@groups')->name('users.groups');
    Route::get('/users/{id}/destroy', 'UsersController@destroyConfirmation')->name('users.destroy-confirmation');

    // Departments Controller
    Route::get('/departments', 'DepartmentsController@loadDepartmentsByParentId')->name('departments.children');

    Route::prefix('users')->group(function(){
        // Coordinator Controller
        Route::get('/coordinators/create', 'CoordinatorController@create')->name('coordinators.create');
        Route::post('/coordinators', 'CoordinatorController@store')->name('coordinators.store');
        Route::get('/coordinators', 'CoordinatorController@index')->name('coordinators.index');
    });


    Route::resource('/users', 'UsersController');
});