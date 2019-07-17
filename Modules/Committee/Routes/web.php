<?php
Route::group(['middleware' => 'auth'], function() {
    Route::resource('committees', 'CommitteeController');
    Route::post('committees/upload-document', 'CommitteeDocumentController@upload')->name('committees.upload-document');
    Route::delete('committees/{document}/delete-document', 'CommitteeDocumentController@delete')->name('committees.delete-document');
});