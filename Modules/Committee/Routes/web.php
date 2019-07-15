<?php
Route::group(['middleware' => 'auth'], function() {
    Route::resource('committees', 'CommitteeController');
});