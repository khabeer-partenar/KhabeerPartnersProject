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
    
    Route::get('/departments-search/{type}', 'SystemManagementController@search')->name('search');
    Route::get('/departments-types', 'SystemManagementController@departmentsTypes')->name('departmentsTypes');

});