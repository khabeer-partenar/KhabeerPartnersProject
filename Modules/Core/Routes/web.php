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


header('Vary:X-Requested-With');

Route::group(['middleware' => 'web', 'as' => 'core.', 'prefix' => 'core'], function()
{
    // Apps Routes
    Route::get('/apps', 'AppsController@index')->name('apps.index');
    Route::post('/apps', 'AppsController@store')->name('apps.store');
    Route::put('/apps/{id}', 'AppsController@update')->name('apps.update');
    Route::delete('/apps/{id}', 'AppsController@destroy')->name('apps.destroy');
    Route::get('/authorized-apps', 'AuthorizedAppsController@index');


    // Groups Routes
    Route::get('/groups/id-{groupId}', 'GroupsController@index')->name('groups.index');
    Route::resource('/groups', 'GroupsController');
    Route::get('/groups/{id}/permissions', 'PermissionsController@index')->name('group_permissions');
    Route::post('/groups/{id}/attach-user', 'GroupsController@attachUser')->name('attach_user_to_group');
    Route::delete('/groups/{id}/detach-user/{userId}', 'GroupsController@detachUser')->name('detach_user_to_group');
    Route::get('/groups/{id}/users', 'GroupsController@users')->name('group_users');

    // User Routes
    Route::get('/users/search', 'UsersController@search')->name('users.search');
    Route::get('/users/upgrate-to-super-admin/{userID}', 'UsersController@upgrateToSuperAdmin')->name('users.upgrate_to_super_admin');
    Route::get('/users/groups', 'UsersController@groups')->name('users.groups');
    Route::get('/users/{id}/destroy', 'UsersController@destroyConfirmation')->name('users.destroy-confirmation');
    Route::resource('/users', 'UsersController');

    // Permissions Routes
    Route::post('/{permissionable}/{permissionableId}/permissions', 'PermissionsController@store');
    Route::delete('/permissions/{id}', 'PermissionsController@destroy');


    // Departments Routes
    Route::get('/departments/{parentId}', 'DepartmentsController@loadDepartmentsTypesByParentId')->name('departments.load_departments_types_by_parent_id');
});