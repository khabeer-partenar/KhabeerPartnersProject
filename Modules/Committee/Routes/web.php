<?php
Route::group(['middleware' => ['auth', 'see.committee']], function() {
    Route::resource('committees', 'CommitteeController');
    Route::post('committees/upload-document', 'CommitteeDocumentController@upload')->name('committees.upload-document');
    Route::post('committees/{committee}/upload-document-direct', 'CommitteeDocumentController@uploadForCommittee')->name('committees.upload-document-direct');
    Route::delete('committees/{document}/delete-document', 'CommitteeDocumentController@delete')->name('committees.delete-document');
    Route::get('committees/delegates/{committee_id}', 'CommitteeController@getDelegatesWithDetails')->name('committees.get.delegate');

});

Route::get('/testing', function (){
    $childrenDepartments = auth()->user()->parentDepartment->referenceChildrenDepartments()->pluck('id')->toArray();
    $departmentsId = array_merge($childrenDepartments, [auth()->user()->parent_department_id]);
    $committeeIds = \Modules\Committee\Entities\CommitteeDepartment::whereIn('department_id', $departmentsId)->pluck('committee_id');
    $committee = \Modules\Committee\Entities\Committee::whereIn('id', $committeeIds)->get();
    dd($committee);
});