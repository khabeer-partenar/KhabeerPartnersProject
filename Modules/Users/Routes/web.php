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
        Route::resource('/coordinators', 'CoordinatorController');
    });


    // Users Controller
    Route::get('/users/search', 'UsersController@search')->name('users.search');
    Route::get('/users/search-by-name', 'UsersController@searchByName')->name('users.searchByName');
    Route::get('/users/upgrate-to-super-admin/{user}', 'UsersController@upgrateToSuperAdmin')->name('users.upgrate_to_super_admin');
    Route::get('/users/groups', 'UsersController@groups')->name('users.groups');
    Route::get('/users/{user}/destroy', 'UsersController@destroyConfirmation')->name('users.destroy-confirmation');
    Route::get('/users/{user}/secretaries', 'UsersController@secretaries')->name('users.secretaries');
    Route::get('/users/{user}/edit/secretaries', 'UsersController@editSecretaries')->name('users.edit_secretaries');
    Route::put('/users/{user}/edit/secretaries', 'UsersController@updateSecretaries')->name('users.update_secretaries');
    Route::resource('/users', 'UsersController');
});
