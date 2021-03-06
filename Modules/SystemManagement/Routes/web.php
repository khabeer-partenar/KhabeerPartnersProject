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

Route::group(['middleware' => ['auth', 'still.loggedIn'], 'as' => 'system-management.', 'prefix' => 'system-management'], function()
{
    
    Route::group(['as' => 'departments.', 'prefix' => 'departments'], function()
    {
        Route::get('/children', 'DepartmentController@loadDepartmentsByParentId')->name('children');
        Route::get('/children/Delegates', 'DepartmentController@loadDepartmentsByParentIdForDelegates')->name('childrenForDelegates');
        Route::get('/search/{type}', 'DepartmentController@search')->name('search');
        Route::delete('/{department}', 'DepartmentController@destroy')->name('destroy');
        Route::put('/department/{department}/update-order', 'DepartmentController@updateOrder')->name('updateOrder');
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

    Route::group(['as' => 'departments-authorities.', 'prefix' => 'departments-authorities'], function()
    {
        Route::get('/', 'DepartmentController@departmentsAuthorities')->name('index');
        Route::get('/create', 'DepartmentController@departmentsAuthoritiesCreate')->name('create');
        Route::post('/', 'DepartmentController@departmentsAuthoritiesStore')->name('store');
        Route::get('/{department}/edit', 'DepartmentController@departmentsAuthoritiesEdit')->name('edit');
        Route::put('/{department}/edit', 'DepartmentController@departmentsAuthoritiesUpdate')->name('update');
    });

    Route::group(['as' => 'source-recommendation-study.', 'prefix' => 'source-recommendation-study'], function()
    {
        Route::get('/', 'SourceRecommendationStudyController@index')->name('index');
        Route::get('/{department}/edit', 'SourceRecommendationStudyController@edit')->name('edit');
        Route::put('/{department}/edit', 'SourceRecommendationStudyController@update')->name('update');
    });


    Route::group(['as' => 'meetings-rooms.', 'prefix' => 'meetings-rooms'], function()
    {
        Route::get('/', 'MeetingsRoomsController@index')->name('index');
        Route::get('/create', 'MeetingsRoomsController@create')->name('create');
        Route::post('/', 'MeetingsRoomsController@store')->name('store');
        Route::get('/{meetingRoom}/edit', 'MeetingsRoomsController@edit')->name('edit');
        Route::put('/{meetingRoom}/edit', 'MeetingsRoomsController@update')->name('update');
        Route::delete('/{meetingRoom}/destroy', 'MeetingsRoomsController@destroy')->name('destroy');
        Route::get('/room-with-meetings', 'MeetingsRoomsController@roomWithMeetings')->name('room-with-meetings');
    });


});