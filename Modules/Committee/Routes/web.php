<?php
Route::group(['middleware' => ['auth', 'see.committee']], function() {
    Route::resource('committees', 'CommitteeController');
    Route::post('committees/upload-document', 'CommitteeDocumentController@upload')->name('committees.upload-document');
    Route::post('committees/{committee}/upload-document-direct', 'CommitteeDocumentController@uploadForCommittee')->name('committees.upload-document-direct');
    Route::delete('committees/{document}/delete-document', 'CommitteeDocumentController@delete')->name('committees.delete-document');
});