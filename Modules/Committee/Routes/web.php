<?php

Route::group(['middleware' => ['auth', 'see.committee']], function() {

    Route::prefix('committees')->group(function () {


        // Meeting
        Route::get('{committee}/meetings', 'CommitteeMeetingController@index')->name('committee.meetings');
        Route::get('{committee}/meetings/create', 'CommitteeMeetingController@create')->name('committee.meetings.create');
        Route::get('{committee}/meetings/{meeting}/edit', 'CommitteeMeetingController@edit')->name('committee.meetings.edit');
        Route::put('{committee}/meetings/{meeting}', 'CommitteeMeetingController@update')->name('committee.meetings.update');
        Route::post('{committee}/meetings', 'CommitteeMeetingController@store')->name('committee.meetings.store');
        Route::get('{committee}/meetings/{meeting}', 'CommitteeMeetingController@show')->name('committee.meetings.show');
        Route::delete('{committee}/meetings/{meeting}', 'CommitteeMeetingController@destroy')->name('committee.meetings.cancel');

        // Meeting Multimedia
        Route::get('{committee}/meetings/{meeting}/multimedia', 'MeetingMultimediaController@index')->name('committee.meetings.multimedia');

        // Meeting Documents
        Route::post('{committee}/meeting/{meeting}/document', 'MeetingDocumentController@storeForMeeting')->name('committee.meeting-document.store-meeting');
        Route::post('{committee}/meetings/document', 'MeetingDocumentController@store')->name('committee.meeting-document.store');
        Route::delete('{committee}/meetings/document/{document}', 'MeetingDocumentController@destroy')->name('committee.meeting-document.delete');

        // Delegates Documents
        Route::post('{committee}/meeting/{meeting}/document', 'DelegateDocumentsController@store')->name('committee.meeting-document.store-delegate');
        Route::delete('{committee}/meetings/document/{document}', 'DelegateDocumentsController@destroy')->name('committee.meeting-document.delete-delegate');

        // Delegates
        Route::get('/{committee}/meetings/{meeting}/delegate', 'DelegateMeetingController@show')->name('committees.meetings.delegate.show');
        Route::put('/{committee}/meetings/{meeting}/delegate', 'DelegateMeetingController@update')->name('committees.meetings.delegate.update');

        // Attendance
        Route::get('/{committee}/meetings/{meeting}/attendance', 'MeetingAttendanceController@create')->name('committees.meetings.attendance.create')->middleware('take.attendance');
        Route::post('/{committee}/meetings/{meeting}/attendance', 'MeetingAttendanceController@store')->name('committees.meetings.attendance.store')->middleware('take.attendance');

        // Committee Multimedia
        Route::get('/{committee}/multimedia', 'CommitteeMultimediaController@index')->name('committee.multimedia');

        // Comm Documents
        Route::post('upload-document', 'CommitteeDocumentController@upload')->name('committees.upload-document');
        Route::post('{committee}/upload-document-direct', 'CommitteeDocumentController@uploadForCommittee')->name('committees.upload-document-direct');
        Route::delete('{document}/documents', 'CommitteeDocumentController@delete')->name('committees.delete-document');
        Route::get('documents/{document}/download', 'CommitteeDocumentController@download')->name('committees.document.download');

        // Nomination
        Route::get('/{committee}/delegates', 'CommitteeController@getDelegatesWithDetails')->name('committees.get.delegate');
        Route::get('/{committee}/sendNomination', 'CommitteeController@sendNomination')->name('committees.send.nomination');
        Route::get('/{committee}/NominationDepartments', 'CommitteeController@getNominationDepartmentsWithRef')->name('committee.get.NominationDepartments');
        Route::get('/{committee}/export', 'CommitteeReportController@exportAllInfo')->name('committee.export.all.info');
        Route::get('/{committee}/approve', 'CommitteeController@approve')->name('committees.approve');

        // Delegate's Driver
        Route::post('{committee}/meeting/{meeting}/driver', 'DelegateDriversController@store')->name('meeting.delegate-driver.store-driver');
        Route::get('/drivers', 'DelegateDriversController@index')->name('drivers.search_by_name');
        Route::get('/driver', 'DelegateDriversController@show')->name('drivers.get_by_name');

        // Route::get('/{committee}/meetings/{meeting}/delegate', 'DelegateMeetingController@getDrivers')->name('committee::meetings.delegates.show');

    });
    //AuthorizedName
    Route::prefix('authorized-names')->group(function (){
        Route::get('/', 'AuthorizedNameController@index')->name('committee.authorizedName');
        Route::get('/export', 'AuthorizedNameController@export')->name('committee.export');
        Route::get('/print', 'AuthorizedNameController@print')->name('committee.print');
    });

    Route::resource('committees', 'CommitteeController');

    Route::get('meetings', 'MeetingController@index')->name('meetings.calendar');
    Route::get('meetings/calendar', 'MeetingController@calendar')->name('meetings.calendar.ajax');

});

