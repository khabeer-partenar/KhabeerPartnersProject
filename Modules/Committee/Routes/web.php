<?php

Route::group(['middleware' => ['auth', 'see.committee']], function() {

    Route::resource('committees', 'CommitteeController');

    Route::prefix('committees')->group(function () {
        // Meeting
        Route::get('{committee}/meetings', 'CommitteeMeetingController@index')->name('committee.meetings');
        Route::get('{committee}/meetings/create', 'CommitteeMeetingController@create')->name('committee.meetings.create');
        Route::get('{committee}/meetings/{meeting}/edit', 'CommitteeMeetingController@edit')->name('committee.meetings.edit');
        Route::put('{committee}/meetings/{meeting}', 'CommitteeMeetingController@update')->name('committee.meetings.update');
        Route::post('{committee}/meetings', 'CommitteeMeetingController@store')->name('committee.meetings.store');
        Route::get('{committee}/meetings/{meeting}', 'CommitteeMeetingController@show')->name('committee.meetings.show');
        Route::delete('{committee}/meetings/{meeting}', 'CommitteeMeetingController@destroy')->name('committee.meetings.cancel');

        Route::post('{committee}/meeting/{meeting}/document', 'MeetingDocumentController@storeForMeeting')->name('committee.meeting-document.store-meeting');
        Route::post('{committee}/meetings/document', 'MeetingDocumentController@store')->name('committee.meeting-document.store');
        Route::delete('{committee}/meetings/document/{document}', 'MeetingDocumentController@destroy')->name('committee.meeting-document.delete');

        Route::get('/{committee}/meetings/{meeting}/delegate', 'DelegateMeetingController@show')->name('committees.meetings.delegate.show');
        Route::put('/{committee}/meetings/{meeting}/delegate', 'DelegateMeetingController@update')->name('committees.meetings.delegate.update');

        Route::get('/{committee}/meetings/{meeting}/attendance', 'MeetingAttendanceController@create')->name('committees.meetings.attendance.create');

        Route::post('upload-document', 'CommitteeDocumentController@upload')->name('committees.upload-document');
        Route::post('{committee}/upload-document-direct', 'CommitteeDocumentController@uploadForCommittee')->name('committees.upload-document-direct');
        Route::delete('{document}/documents', 'CommitteeDocumentController@delete')->name('committees.delete-document');
        Route::get('documents/{document}/download', 'CommitteeDocumentController@download')->name('committees.document.download');
        Route::get('delegates/{committee_id}', 'CommitteeController@getDelegatesWithDetails')->name('committees.get.delegate');
        Route::get('sendNomination/{committee}', 'CommitteeController@sendNomination')->name('committees.send.nomination');
        Route::get('NominationDepartments/{committee}', 'CommitteeController@getNominationDepartmentsWithRef')->name('committee.get.NominationDepartments');
        Route::get('export/{committee}', 'CommitteeReportController@exportAllInfo')->name('committee.export.all.info');
        Route::get('approve/{committee}', 'CommitteeController@approveCommittee')->name('committees.approve');
    });

    Route::get('meetings', 'MeetingController@index')->name('meetings.calendar');

});

