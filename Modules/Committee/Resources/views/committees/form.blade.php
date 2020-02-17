<p class="underLine">{{ __('committee::committees.treatment information') }}</p>

<div class="row">

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('resource_staff_number') ? ' has-error' : '' }}">
            <label for="resource_staff_number" class="control-label">
                {{ __('committee::committees.resource_staff_number') }}
                <span style="color: red">*</span>
            </label>

            {!! Form::text('resource_staff_number', null, ['id' => 'resource_staff_number', 'class' => 'form_control']) !!}
            @include('layouts.dashboard.form-error', ['key' => 'resource_staff_number'])
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('resource_at') ? ' has-error' : '' }}">
            <label for="resource_at" class="control-label">
                {{ __('committee::committees.resource_at') }}
                <span style="color: red">*</span>
            </label>

            @php
                $resourceAt = isset($committee) ? $committee->resource_at->format('m/d/Y'):null;
                if (old('resource_at')){
                    $resourceAt = old('resource_at');
                }
            @endphp
            <input type="text" name="resource_at" id="resource_at" value="{{ $resourceAt }}" class="form_control date-picker" autocomplete="off">
            @include('layouts.dashboard.form-error', ['key' => 'resource_at'])
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('department_out_number') ? ' has-error' : '' }}">
            <label for="department_out_number" class="control-label">
                {{ __('committee::committees.department_out_number') }}
                <span style="color: red">*</span>
            </label>

            {!! Form::text('department_out_number', null, ['id' => 'department_out_number', 'class' => 'form_control']) !!}
            @include('layouts.dashboard.form-error', ['key' => 'department_out_number'])
        </div>
    </div>

</div>

<br />

<div class="row">
    
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('department_out_date') ? ' has-error' : '' }}">
            <label for="resource_at" class="control-label">
                {{ __('committee::committees.department_out_date') }}
                <span style="color: red">*</span>
            </label>

            @php
                $departmentOutDate = isset($committee) ? $committee->department_out_date->format('m/d/Y'):null;
                if (old('department_out_date')){
                    $departmentOutDate = old('department_out_date');
                }
            @endphp
            <input type="text" name="department_out_date" id="department_out_date" value="{{ $departmentOutDate }}" class="form_control date-picker" autocomplete="off">
            @include('layouts.dashboard.form-error', ['key' => 'department_out_date'])
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('treatment_type_id') ? ' has-error' : '' }}">
            <label for="treatment_type_id" class="control-label">
                {{ __('committee::committees.treatment_type_id') }}
                <span style="color: red">*</span>
            </label>

            <select name="treatment_type_id" id="treatment_type_id" class="form_control select2">
                <option value="0">{{ __('committee::committees.please choose') }}</option>
                @php
                    $treatmentTypeId = isset($committee) ? $committee->treatment_type_id:'';
                    if (old('treatment_type_id')){
                        $treatmentTypeId = old('treatment_type_id');
                    }
                @endphp
                @foreach($treatmentTypes as $id => $name)
                    <option value="{{ $id }}" {{ $treatmentTypeId == $id ? 'selected':'' }}>{{ $name }}</option>
                @endforeach
            </select>
            @include('layouts.dashboard.form-error', ['key' => 'treatment_type_id'])
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('resource_by') ? ' has-error' : '' }}">
            <label for="resource_by" class="control-label">
                {{ __('committee::committees.resource_by') }}
                <span style="color: red">*</span>
            </label>

            <select name="resource_by" id="resource_by" class="form_control select2">
                <option value="0">{{ __('committee::committees.please choose') }}</option>
                @php
                    $resourceBy = isset($committee) ? $committee->resource_by:'';
                    if (old('resource_by')){
                        $resourceBy = old('resource_by');
                    }
                @endphp
                @foreach($departments as $id => $name)
                    <option value="{{ $id }}" {{ $resourceBy == $id ? 'selected':'' }}>{{ $name }}</option>
                @endforeach
            </select>
            @include('layouts.dashboard.form-error', ['key' => 'resource_by'])
        </div>
    </div>

</div>

<br />

<div class="row">
    
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('treatment_number') ? ' has-error' : '' }}">
            <label for="treatment_number" class="control-label">
                {{ __('committee::committees.treatment_number') }}
                <span style="color: red">*</span>
            </label>

            {!! Form::number('treatment_number', null, ['id' => 'treatment_number', 'class' => 'form_control']) !!}
            @include('layouts.dashboard.form-error', ['key' => 'treatment_number'])
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('treatment_time') ? ' has-error' : '' }}">
            <label for="treatment_time" class="control-label">
                {{ __('committee::committees.treatment_time') }}
                <span style="color: red">*</span>
            </label>

            @php
                $treatmentTime = isset($committee) ? $committee->treatment_time->format('m/d/Y'):null;
                if (old('treatment_time')){
                    $treatmentTime = old('treatment_time');
                }
            @endphp
            <input type="text" name="treatment_time" id="treatment_time" value="{{ $treatmentTime }}" class="form_control date-picker" autocomplete="off">
            @include('layouts.dashboard.form-error', ['key' => 'treatment_time'])
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('recommended_by_id') ? ' has-error' : '' }}">
            <label for="recommended_by_id" class="control-label">
                {{ __('committee::committees.recommended_by_id') }}
                <span style="color: red">*</span>
            </label>

            <select name="recommended_by_id" id="recommended_by_id" class="form_control select2">
                <option value="0">{{ __('committee::committees.please choose') }}</option>
                @php
                    $recommendedBy = isset($committee) ? $committee->recommended_by_id:'';
                    if (old('recommended_by_id')){
                        $recommendedBy = old('recommended_by_id');
                    }
                @endphp
                @foreach($recommendedDepartments as $id => $name)
                    <option value="{{ $id }}" {{ $recommendedBy == $id ? 'selected':'' }}>{{ $name }}</option>
                @endforeach
            </select>
            @include('layouts.dashboard.form-error', ['key' => 'recommended_by_id'])
        </div>
    </div>

</div>

<br />

<div class="row">

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('recommendation_number') ? ' has-error' : '' }}">
            <label for="recommendation_number" class="control-label">
                {{ __('committee::committees.recommendation_number') }}
                <span style="color: red">*</span>
            </label>

            {!! Form::text('recommendation_number', null, ['id' => 'recommendation_number', 'class' => 'form_control']) !!}
            @include('layouts.dashboard.form-error', ['key' => 'recommendation_number'])
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('recommended_at') ? ' has-error' : '' }}">
            <label for="recommended_at" class="control-label">
                {{ __('committee::committees.recommended_at') }}
                <span style="color: red">*</span>
            </label>

            @php
                $recommendedAt = isset($committee) ? $committee->recommended_at->format('m/d/Y'):null;
                if (old('recommended_at')){
                    $recommendedAt = old('recommended_at');
                }
            @endphp
            <input type="text" name="recommended_at" id="recommended_at" value="{{ $recommendedAt }}" class="form_control date-picker" autocomplete="off">
            @include('layouts.dashboard.form-error', ['key' => 'recommended_at'])
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('source_of_study_id') ? ' has-error' : '' }}">
            <label for="source_of_study_id" class="control-label">
                {{ __('committee::committees.source_of_study_id') }}
                <span style="color: red">*</span>
            </label>

            <select name="source_of_study_id" id="source_of_study_id" class="form_control select2">
                <option value="0">{{ __('committee::committees.please choose') }}</option>
                @php
                    $sourceOfStudy = isset($committee) ? $committee->source_of_study_id:'';
                    if (old('source_of_study_id')){
                        $sourceOfStudy = old('source_of_study_id');
                    }
                @endphp
                @foreach($sourceOfStudiesDepartments as $id => $name)
                    <option value="{{ $id }}" {{ $sourceOfStudy == $id ? 'selected':'' }}>{{ $name }}</option>
                @endforeach
            </select>
            @include('layouts.dashboard.form-error', ['key' => 'source_of_study_id'])
        </div>
    </div>

</div>

<br />

<div class="row">

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('treatment_urgency_id') ? ' has-error' : '' }}">
            <label for="treatment_urgency_id" class="control-label">
                {{ __('committee::committees.treatment_urgency_id') }}
                <span style="color: red">*</span>
            </label>

            <select name="treatment_urgency_id" id="treatment_urgency_id" class="form_control select2">
                <option value="0">{{ __('committee::committees.please choose') }}</option>
                @php
                    $treatmentUrgencyId = isset($committee) ? $committee->treatment_urgency_id:'';
                    if (old('treatment_urgency_id')){
                        $treatmentUrgencyId = old('treatment_urgency_id');
                    }
                @endphp
                @foreach($treatmentUrgency as $id => $name)
                    <option value="{{ $id }}" {{ $treatmentUrgencyId == $id ? 'selected':'' }}>{{ $name }}</option>
                @endforeach
            </select>
            @include('layouts.dashboard.form-error', ['key' => 'treatment_urgency_id'])
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('treatment_importance_id') ? ' has-error' : '' }}">
            <label for="treatment_importance_id" class="control-label">
                {{ __('committee::committees.treatment_importance_id') }}
                <span style="color: red">*</span>
            </label>

            <select name="treatment_importance_id" id="treatment_importance_id" class="form_control select2">
                <option value="0">{{ __('committee::committees.please choose') }}</option>
                @php
                    $treatmentImportanceId = isset($committee) ? $committee->treatment_importance_id:'';
                    if (old('treatment_importance_id')){
                        $treatmentImportanceId = old('treatment_importance_id');
                    }
                @endphp
                @foreach($treatmentImportance as $id => $name)
                    <option value="{{ $id }}" {{ $treatmentImportanceId == $id ? 'selected':'' }}>{{ $name }}</option>
                @endforeach
            </select>
            @include('layouts.dashboard.form-error', ['key' => 'treatment_importance_id'])
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('first_meeting_at') ? ' has-error' : '' }}">
            <label for="first_meeting_at" class="control-label">
                {{ __('committee::committees.first_meeting_at') }}
                <span style="color: red">*</span>
            </label>

            @php
                $meetingAt = isset($committee) ? $committee->first_meeting_at->format('d/m/Y H:i'):null;
                if (old('first_meeting_at')){
                    $meetingAt = old('first_meeting_at');
                }
            @endphp
            <input type="text" name="first_meeting_at" id="first_meeting_at" value="{{ $meetingAt }}" class="form_control datetime-picker" autocomplete="off" {{ isset($committee) ? 'disabled':'' }}>
            @include('layouts.dashboard.form-error', ['key' => 'first_meeting_at'])
        </div>
    </div>

</div>

<br />

<div class="row">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('subject') ? ' has-error' : '' }}">
            <label for="subject" class="control-label">
                {{ __('committee::committees.subject') }}
                <span style="color: red">*</span>
            </label>

            {!! Form::text('subject', null, ['id' => 'subject', 'class' => 'form_control']) !!}
            @include('layouts.dashboard.form-error', ['key' => 'subject'])
        </div>
    </div>
</div>

<br />

<div class="row">
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('president_id') ? ' has-error' : '' }}">
            {!! Form::label('president_id',  __('committee::committees.president_id'), ['class' => 'control-label']) !!}

            <select name="president_id" id="president_id" class="form_control select2">
                <option value="0">{{ __('committee::committees.please choose') }}</option>
                @php
                    $presidentId = isset($committee) ? $committee->president_id:'';
                    if (old('president_id')){
                        $presidentId = old('president_id');
                    }
                @endphp
                @foreach($studyCommission as $id => $name)
                    <option value="{{ $id }}" {{ $presidentId == $id ? 'selected':'' }}>{{ $name }}</option>
                @endforeach
            </select>
            @include('layouts.dashboard.form-error', ['key' => 'president_id'])
        </div>
    </div>

    <div class="col-md-8">
        <div class="form-group {{ $errors->has('tasks') ? ' has-error' : '' }}">
            {!! Form::label('tasks',  __('committee::committees.tasks'), ['class' => 'control-label']) !!}

            {!! Form::textArea('tasks', null, ['id' => 'tasks', 'class' => 'form_control', 'rows' => '5']) !!}
            @include('layouts.dashboard.form-error', ['key' => 'tasks'])
        </div>
    </div>
</div>

<br />

<div class="row">
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('advisor_id') ? ' has-error' : '' }}">
            <label for="advisor_id" class="control-label">
                {{ __('committee::committees.advisor_id') }}
                <span style="color: red">*</span>
            </label>

            <select name="advisor_id" id="advisor_id" class="form_control select2">
                <option value="0">{{ __('committee::committees.please choose') }}</option>
                @php
                    $advisorId = isset($committee) ? $committee->advisor_id:'';
                    if (old('resource_by')){
                        $advisorId = old('advisor_id');
                    }
                @endphp
                @foreach($advisors as $id => $name)
                    <option value="{{ $id }}" {{ $advisorId == $id ? 'selected':'' }}>{{ $name }}</option>
                @endforeach
            </select>
            @include('layouts.dashboard.form-error', ['key' => 'advisor_id'])
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group {{ $errors->has('participant_advisors') ? ' has-error' : '' }}">
            {!! Form::label('participant_advisors',  __('committee::committees.participant_advisors'), ['class' => 'control-label']) !!}

            <select name="participant_advisors[]" data-placeholder="{{ __('committee::committees.please choose') }}"
                    id="participant_advisors" class="form_control select2" multiple>
                @php
                    $participantIds = isset($committee) ? $committee->participantAdvisors()->pluck('users.id')->toArray():[];
                    if (old('participant_advisors')){
                        $participantIds = old('participant_advisors');
                    }
                @endphp
                @foreach($allAdvisors as $id => $name)
                    <option value="{{ $id }}"
                            {{ in_array($id, $participantIds) ? 'selected':'' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
            @include('layouts.dashboard.form-error', ['key' => 'participant_advisors'])
        </div>
    </div>
</div>

<br />

<div class="row">
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('members_count') ? ' has-error' : '' }}">
            {!! Form::label('members_count',  __('committee::committees.members_count'), ['class' => 'control-label']) !!}
            @php
                $count = isset($committee) ? $committee->members_count:0;
            @endphp

            {!! Form::text('members_count', $count, ['id' => 'members_count', 'class' => 'form_control', 'disabled']) !!}
            @include('layouts.dashboard.form-error', ['key' => 'members_count'])
        </div>
    </div>
</div>

<hr>

{{-- Departments Table --}}
<p class="underLine">{{ __('committee::committees.departments to participate') }}</p>

<div class="row">
    <div class="col-md-4">
        {!! Form::label('tasks',  __('committee::committees.department name'), ['class' => 'control-label']) !!}

        <select id="departments" class="form_control select2">
            <option value="0">{{ __('committee::committees.please choose') }}</option>
            @php
                $departmentsIds = isset($committee) ? $committee->participantDepartments()->pluck('departments.id')->toArray():[];
                if (old('departments')){
                    $departmentsIds = old('departments');
                }
            @endphp
            @foreach($departmentsWithRef as $department)
                <option value="{{ $department->id }}"
                    {{ in_array($department->id, $departmentsIds) ? 'disabled':'' }}>
                    {{ ($department->referenceDepartment ? $department->referenceDepartment->name . ' - ':'') . $department->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <button type="button" class="btn btn-primary_s" id="addDepartmentToParticipants">إضافة</button>
    </div>
</div>

<div class="row mb-10">
    <div class="col-md-12">
        <table class="table table-bordered mt-10">
            <thead>
                <tr>
                    <th scope="col">{{ __('committee::committees.the departments to participate') }}</th>
                    <th scope="col">{{ __('committee::committees.Nomination criteria') }}</th>
                    <th scope="col">{{ __('committee::committees.options') }}</th>
                </tr>
            </thead>
            <tbody id="departmentsTableBody">
                {{-- Edit --}}
                @if(isset($committee))
                    @php
                        $departments = $committee->participantDepartments()->get();
                    @endphp
                    @foreach($departments as $department)
                        <tr class="trow" id="trow-{{ $department->id }}">
                            <th scope="row">
                                {{ $department->name }}
                                <input name="departments[{{$department->id}}]" hidden value="{{ $id }}">
                            </th>
                            <td>
                                <input name="departments[{{$department->id}}][nomination_criteria]"
                                       value="{{ $department->pivot->nomination_criteria }}"
                                       class="nomination_criteria">
                            </td>
                            <td><button type="button" class="btn btn-danger trow-remove" data-id="{{ $department->id }}"
                                        data-remove-row="#trow-{{ $department->id }}">حذف</button></td>
                        </tr>
                    @endforeach
                @else
                    @if(old('departments') && is_array(old('departments')))
                        @foreach(old('departments') as $id => $departmentArray)
                            <tr class="trow" id="trow-{{ $id }}">
                                <th scope="row">
                                    {{ old('text') && is_array(old('text')) ? old('text')[$id]:'' }}
                                    <input name="departments[{{$id}}]" hidden value="{{ $id }}">
                                </th>
                                <td>
                                    <input name="departments[{{$id}}][nomination_criteria]"
                                           value="{{ $departmentArray["nomination_criteria"] }}"
                                           class="nomination_criteria">
                                </td>
                                <td><button type="button" class="btn btn-danger trow-remove" data-id="{{ $id }}" data-remove-row="#trow-{{ $id }}">حذف</button></td>
                            </tr>
                        @endforeach
                    @endif
                @endif
            </tbody>
        </table>
    </div>
</div>

<hr>

<p class="underLine">{{ __('committee::committees.upload_files') }}</p>

<div class="row">
    <div class="col-md-5">
        <div class="col-md-4">
            {!! Form::label('tasks',  __('committee::committees.file description'), ['class' => 'control-label']) !!}
        </div>

        <div class="col-md-8">
            {!! Form::text('file_description', null, ['id' => 'file_description', 'class' => 'form_control']) !!}
        </div>
    </div>

    <div class="col-md-5">
        <div class="col-md-3">
            <label>
                <button type="button" id="upload-file" class="btn btn-warning">
                    رفع
                </button>
            </label>
        </div>
        <div class="col-md-9">
            <span id="fileName"></span>
            <div class="hidden">
                <input type="file" name="uploadedFile" id="upload-file-browse">
            </div>
        </div>
    </div>

    <div class="col-md-2">
        @php
            if(isset($committee)) {
                $documentsCount = $committee->documents()->count();
            } else {
                $documentsCount = $documents->count();
            }
        @endphp
        <button type="button" data-order="{{ $documentsCount }}" class="btn btn-primary" id="saveFiles"
                data-url="{{ isset($committee) ? route('committees.upload-document-direct', compact('committee')):route('committees.upload-document') }}">إضافة</button>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered mt-10">
            <thead>
            <tr>
                <th scope="col">{{ __('committee::committees.number') }}</th>
                <th scope="col">{{ __('committee::committees.file description') }}</th>
                <th scope="col">{{ __('committee::committees.file path') }}</th>
                <th scope="col">{{ __('committee::committees.options') }}</th>
            </tr>
            </thead>
            <tbody id="files">
            @if(isset($committee))
                @foreach($committee->documents as $document)
                    <tr id="file-{{ $document->id }}">
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $document->description ? $document->description:''}}</td>
                        <td>
                            <a href="{{ $document->full_path }}">{{ $document->name }}</a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger file-remove"
                                    data-remove-url="{{ route('committees.delete-document', $document) }}"
                                    data-remove-row="#file-{{ $document->id }}">
                                حذف
                            </button>
                        </td>
                    </tr>
                @endforeach
            @else
                @foreach($documents as $document)
                    <tr id="file-{{ $document->id }}">
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $document->description ? $document->description:''}}</td>
                        <td>
                            <a href="{{ $document->full_path }}">{{ $document->name }}</a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger file-remove"
                                    data-remove-url="{{ route('committees.delete-document', $document) }}"
                                    data-remove-row="#file-{{ $document->id }}">
                                حذف
                            </button>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>

