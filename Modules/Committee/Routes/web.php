<?php

Route::group(['middleware' => ['auth', 'see.committee', 'see.meeting', 'still.loggedIn']], function () {

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
        Route::post('{committee}/meetings/{meeting}/export-word', 'MeetingMultimediaController@exportWord')->name('committee.meetings.multimedia.export-word');

        // Meeting Documents
        Route::post('{committee}/meetings/{meeting}/document', 'MeetingDocumentController@storeForMeeting')->name('committee.meeting-document.store-meeting');
        Route::post('{committee}/meetings/document', 'MeetingDocumentController@store')->name('committee.meeting-document.store');
        Route::delete('{committee}/meetings/{document}/document', 'MeetingDocumentController@destroy')->name('committee.meeting-document.delete');

        // Delegates Documents
        Route::post('{committee}/meetings/{meeting}/delegate-document', 'DelegateMeetingDocumentController@store')->name('committee.meeting-document.store-delegate');
        Route::delete('{committee}/meetings/{document}/delegate-document', 'DelegateMeetingDocumentController@destroy')->name('committee.meeting-document.delete-delegate');
        Route::post('{committee}/delegate-document', 'DelegateCommitteeDocumentController@store')->name('committee.document.store-delegate');
        Route::delete('{committee}/delegate-document/{document}', 'DelegateCommitteeDocumentController@destroy')->name('committee.document.delete-delegate');

        // Delegates
        Route::get('/{committee}/meetings/{meeting}/delegate', 'DelegateMeetingController@show')->name('committees.meetings.delegate.show');
        Route::put('/{committee}/meetings/{meeting}/delegate', 'DelegateMeetingController@update')->name('committees.meetings.delegate.update');

        // Coordinator
        Route::get('/{committee}/meetings/{meeting}/coordinator', 'CoordinatorMeetingController@show')->name('committees.meetings.co.show');
        Route::put('/{committee}/meetings/{meeting}/nominate', 'DelegateMeetingController@nominate')->name('committee.meetings.nominate');

        // Attendance
        Route::get('/{committee}/attendance', 'CommitteeAttendanceController@show')->name('committees.attendance');
        Route::get('/{committee}/meetings/{meeting}/attendance', 'MeetingAttendanceController@create')->name('committees.meetings.attendance.create')->middleware('take.attendance');
        Route::post('/{committee}/meetings/{meeting}/attendance', 'MeetingAttendanceController@store')->name('committees.meetings.attendance.store')->middleware('take.attendance');
        Route::get('/{committee}/print', 'CommitteeAttendanceController@print')->name('attendance.print');


        // Committee Multimedia
        Route::get('/{committee}/multimedia', 'CommitteeMultimediaController@index')->name('committee.multimedia');
        Route::get('/{committee}/multimedia/create', 'CommitteeMultimediaController@create')->name('committee.multimedia.create');
        Route::post('/{committee}/multimedia', 'CommitteeMultimediaController@store')->name('committee.multimedia.store');
        Route::get('/export', 'CommitteeMultimediaController@export')->name('committee.multimedia.export');
        Route::post('{committee}/export-word', 'CommitteeMultimediaController@exportWord')->name('committee.multimedia.export-word');


        // Committee Notification

        Route::get('/{committee}/notification', 'CommitteeNotificationController@sendUrgentCommiteeNotification')->name('committee.notification');

        // Comm Documents
        Route::post('upload-document', 'CommitteeDocumentController@upload')->name('committees.upload-document');
        Route::post('{committee}/upload-document-direct', 'CommitteeDocumentController@uploadForCommittee')->name('committees.upload-document-direct');
        Route::delete('{document}/documents', 'CommitteeDocumentController@delete')->name('committees.delete-document');
        Route::get('documents/{document}/download', 'CommitteeDocumentController@download')->name('committees.document.download');

        // Nomination
        Route::get('/{committee}/delegates', 'CommitteeController@getDelegatesWithDetails')->name('committees.get.delegate');
        Route::get('/{committee}/sendNomination', 'CommitteeController@sendNomination')->name('committees.send.nomination');
        Route::get('/{committee}/NominationDepartments', 'CommitteeController@getNominationDepartmentsWithRef')->name('committee.get.NominationDepartments');
        Route::get('/{committee}/export', 'CommitteeReportController@show')->name('committee.export.all.info');
        Route::get('/{committee}/approve', 'CommitteeController@approve')->name('committees.approve');

        // Delegate's Driver
        Route::post('/driver', 'DelegateDriversController@store')->name('meeting.delegate-driver.store-driver');
        Route::get('/drivers', 'DelegateDriversController@index')->name('drivers.search_by_name');
        Route::get('/driver', 'DelegateDriversController@show')->name('drivers.get_by_name');

        // Export Comm
        Route::get('exported', 'CommitteeController@exported')->name('committees.exported');
        Route::post('{committee}/exported', 'CommitteeController@export')->name('committees.export');
    });
    //AuthorizedName
    Route::prefix('authorized-names')->group(function () {
        Route::get('/', 'AuthorizedNameController@index')->name('committee.authorizedName');
        Route::get('/export', 'AuthorizedNameController@export')->name('committee.export');
        Route::get('/print', 'AuthorizedNameController@print')->name('committee.print');
    });

    Route::resource('committees', 'CommitteeController')->middleware('prevent.back');

    Route::get('meetings', 'MeetingController@index')->name('meetings.calendar');
    Route::get('meetings/calendar', 'MeetingController@calendar')->name('meetings.calendar.ajax');
});
