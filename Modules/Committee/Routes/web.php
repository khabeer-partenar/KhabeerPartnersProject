<?php

Route::group(['middleware' => ['auth', 'see.committee']], function() {
    Route::resource('committees', 'CommitteeController');
    Route::post('committees/upload-document', 'CommitteeDocumentController@upload')->name('committees.upload-document');
    Route::post('committees/{committee}/upload-document-direct', 'CommitteeDocumentController@uploadForCommittee')->name('committees.upload-document-direct');
    Route::delete('committees/{document}/documents', 'CommitteeDocumentController@delete')->name('committees.delete-document');
    Route::get('committees/documents/{document}/download', 'CommitteeDocumentController@download')->name('committees.document.download');
    Route::get('committees/delegates/{committee_id}', 'CommitteeController@getDelegatesWithDetails')->name('committees.get.delegate');
    Route::get('/committees/sendNomination/{committee}', 'CommitteeController@sendNomination')->name('committees.send.nomination');
    Route::get('/committees/NominationDepartments/{committee}', 'CommitteeController@getNominationDepartmentsWithRef')->name('committee.get.NominationDepartments');
    Route::get('committees/export/{committee}', 'CommitteeReportController@exportAllInfo')->name('committee.export.all.info');

});

