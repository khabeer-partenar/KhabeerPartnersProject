<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'guest:api'], function()
{
    Route::post('login', 'AuthController@login');
});


Route::group(['middleware' => 'auth:api'], function()
{
    // Coordinator Controller
    Route::post('/coordinators', 'API\CoordinatorController@store');


    Route::resource('/users', 'API\CoordinatorController')->only('index', 'create', 'store', 'update', 'destroy');

    Route::get('/logout', 'AuthController@logout')->name('logout');
});