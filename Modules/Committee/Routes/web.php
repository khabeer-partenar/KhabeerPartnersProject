<?php

Route::group(['middleware' => ['auth', 'see.committee']], function() {
    
    Route::resource('committees', 'CommitteeController');
    // Meeting
    Route::get('committees/{committee}/meetings', 'CommitteeMeetingController@index')->name('committee.meetings');
    Route::get('committees/{committee}/meetings/create', 'CommitteeMeetingController@create')->name('committee.meetings.create');
    Route::get('committees/{committee}/meetings/{meeting}/edit', 'CommitteeMeetingController@edit')->name('committee.meetings.edit');
    Route::put('committees/{committee}/meetings/{meeting}', 'CommitteeMeetingController@update')->name('committee.meetings.update');
    Route::post('committees/{committee}/meetings', 'CommitteeMeetingController@store')->name('committee.meetings.store');
    Route::get('committees/{committee}/meetings/{meeting}', 'CommitteeMeetingController@show')->name('committee.meetings.show');
    Route::post('meetings/{committee}/document', 'MeetingDocumentController@store')->name('committee.meeting-document.store');
    Route::delete('meetings/{committee}/document/{document}', 'MeetingDocumentController@destroy')->name('committee.meeting-document.delete');

    Route::post('committees/upload-document', 'CommitteeDocumentController@upload')->name('committees.upload-document');
    Route::post('committees/{committee}/upload-document-direct', 'CommitteeDocumentController@uploadForCommittee')->name('committees.upload-document-direct');
    Route::delete('committees/{document}/documents', 'CommitteeDocumentController@delete')->name('committees.delete-document');
    Route::get('committees/documents/{document}/download', 'CommitteeDocumentController@download')->name('committees.document.download');
    Route::get('committees/delegates/{committee_id}', 'CommitteeController@getDelegatesWithDetails')->name('committees.get.delegate');
    Route::get('/committees/sendNomination/{committee}', 'CommitteeController@sendNomination')->name('committees.send.nomination');
    Route::get('/committees/NominationDepartments/{committee}', 'CommitteeController@getNominationDepartmentsWithRef')->name('committee.get.NominationDepartments');
    Route::get('committees/export/{committee}', 'CommitteeReportController@exportAllInfo')->name('committee.export.all.info');
    Route::get('/committees/approve/{committee}', 'CommitteeController@approveCommittee')->name('committees.approve');
});

