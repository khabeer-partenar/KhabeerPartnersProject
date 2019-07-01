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
    
    Route::get('/departments/search/{type}', 'DepartmentController@search')->name('search');
    
    Route::group(['as' => 'departments-types.', 'prefix' => 'departments-types'], function()
    {
        Route::get('/', 'DepartmentController@departmentsTypes')->name('index');
        Route::get('/create', 'DepartmentController@departmentsTypesCreate')->name('create');
        Route::post('/', 'DepartmentController@departmentsTypesStore')->name('store');
    });

});