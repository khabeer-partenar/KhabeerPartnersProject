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


Route::group(['middleware' => 'web'], function()
{
    Route::get('/', 'IndexController@index')->name('index');
    Route::get('/un_authorized_user', 'IndexController@unauthorizedUser')->name('index.un_authorized_user');
});