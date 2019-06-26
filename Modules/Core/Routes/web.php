<?php
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

    // Permissions Routes
    Route::post('/{permissionable}/{permissionableId}/permissions', 'PermissionsController@store');
    Route::delete('/permissions/{id}', 'PermissionsController@destroy');
});
