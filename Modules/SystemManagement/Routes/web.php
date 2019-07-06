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

Route::group(['middleware' => 'auth', 'as' => 'system-management.', 'prefix' => 'system-management'], function()
{
    
    Route::group(['as' => 'departments.', 'prefix' => 'departments'], function()
    {
        Route::get('/search/{type}', 'DepartmentController@search')->name('search');
        Route::delete('/{department}', 'DepartmentController@destroy')->name('destroy');
    });

    Route::group(['as' => 'departments-types.', 'prefix' => 'departments-types'], function()
    {
        Route::get('/', 'DepartmentController@departmentsTypes')->name('index');
        Route::get('/create', 'DepartmentController@departmentsTypesCreate')->name('create');
        Route::post('/', 'DepartmentController@departmentsTypesStore')->name('store');
        Route::get('/{department}/edit', 'DepartmentController@departmentsTypesEdit')->name('edit');
        Route::put('/{department}/edit', 'DepartmentController@departmentsTypesUpdate')->name('update');
    });


    Route::group(['as' => 'departments-management.', 'prefix' => 'departments-management'], function()
    {
        Route::get('/', 'DepartmentController@departmentsManagement')->name('index');
        Route::get('/create', 'DepartmentController@departmentsManagementCreate')->name('create');
        Route::post('/', 'DepartmentController@departmentsManagementStore')->name('store');
        Route::get('/{department}/edit', 'DepartmentController@departmentsManagementEdit')->name('edit');
        Route::put('/{department}/edit', 'DepartmentController@departmentsManagementUpdate')->name('update');
    });

});