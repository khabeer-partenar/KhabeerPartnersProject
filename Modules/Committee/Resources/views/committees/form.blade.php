<p class="underLine">{{ __('committee::committees.treatment information') }}</p>

<div class="row">

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('resource_staff_number') ? ' has-error' : '' }}">
            {!! Form::label('resource_staff_number', __('committee::committees.resource_staff_number'), ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                {!! Form::text('resource_staff_number', null, ['id' => 'resource_staff_number', 'class' => 'form-control']) !!}
                @include('layouts.dashboard.form-error', ['key' => 'resource_staff_number'])
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('resource_at') ? ' has-error' : '' }}">
            {!! Form::label('resource_at',  __('committee::committees.resource_at'), ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                {!! Form::text('resource_at', null, ['id' => 'resource_at', 'class' => 'form-control date-picker', 'autocomplete' => 'off']) !!}
                @include('layouts.dashboard.form-error', ['key' => 'resource_at'])
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('treatment_type_id') ? ' has-error' : '' }}">
            {!! Form::label('treatment_type_id',  __('committee::committees.treatment_type_id'), ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                <select name="treatment_type_id" id="treatment_type_id" class="form-control select2">
                    <option value="0">{{ __('committee::committees.please choose') }}</option>
                    @foreach($treatmentTypes as $id => $name)
                        <option value="{{ $id }}" {{ old('treatment_type_id') == $id ? 'selected':'' }}>{{ $name }}</option>
                    @endforeach
                </select>
                @include('layouts.dashboard.form-error', ['key' => 'treatment_type_id'])
            </div>
        </div>
    </div>

</div>

<br />

<div class="row">

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('resource_by') ? ' has-error' : '' }}">
            {!! Form::label('resource_by',  __('committee::committees.resource_by'), ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                <select name="resource_by" id="resource_by" class="form-control select2">
                    <option value="0">{{ __('committee::committees.please choose') }}</option>
                    @foreach($departments as $id => $name)
                        <option value="{{ $id }}" {{ old('resource_by') == $id ? 'selected':'' }}>{{ $name }}</option>
                    @endforeach
                </select>
                @include('layouts.dashboard.form-error', ['key' => 'resource_by'])
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('treatment_number') ? ' has-error' : '' }}">
            {!! Form::label('treatment_number', __('committee::committees.treatment_number'), ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                {!! Form::text('treatment_number', null, ['id' => 'treatment_number', 'class' => 'form-control']) !!}
                @include('layouts.dashboard.form-error', ['key' => 'treatment_number'])
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('treatment_time') ? ' has-error' : '' }}">
            {!! Form::label('treatment_time',  __('committee::committees.treatment_time'), ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                {!! Form::text('treatment_time', null, ['id' => 'treatment_time', 'class' => 'form-control date-picker', 'autocomplete' => 'off']) !!}
                @include('layouts.dashboard.form-error', ['key' => 'treatment_time'])
            </div>
        </div>
    </div>
</div>

<br />

<div class="row">

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('recommended_by_id') ? ' has-error' : '' }}">
            {!! Form::label('recommended_by_id',  __('committee::committees.recommended_by_id'), ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                <select name="recommended_by_id" id="recommended_by_id" class="form-control select2">
                    <option value="0">{{ __('committee::committees.please choose') }}</option>
                    @foreach($departments as $id => $name)
                        <option value="{{ $id }}" {{ old('recommended_by_id') == $id ? 'selected':'' }}>{{ $name }}</option>
                    @endforeach
                </select>
                @include('layouts.dashboard.form-error', ['key' => 'recommended_by_id'])
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('recommendation_number') ? ' has-error' : '' }}">
            {!! Form::label('recommendation_number', __('committee::committees.recommendation_number'), ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                {!! Form::text('recommendation_number', null, ['id' => 'recommendation_number', 'class' => 'form-control']) !!}
                @include('layouts.dashboard.form-error', ['key' => 'recommendation_number'])
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('recommended_at') ? ' has-error' : '' }}">
            {!! Form::label('recommended_at',  __('committee::committees.recommended_at'), ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                {!! Form::text('recommended_at', null, ['id' => 'recommended_at', 'class' => 'form-control date-picker', 'autocomplete' => 'off']) !!}
                @include('layouts.dashboard.form-error', ['key' => 'recommended_at'])
            </div>
        </div>
    </div>
</div>

<br />

<div class="row">
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('source_of_study_id') ? ' has-error' : '' }}">
            {!! Form::label('source_of_study_id',  __('committee::committees.source_of_study_id'), ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                <select name="source_of_study_id" id="source_of_study_id" class="form-control select2">
                    <option value="0">{{ __('committee::committees.please choose') }}</option>
                    @foreach($departments as $id => $name)
                        <option value="{{ $id }}" {{ old('source_of_study_id') == $id ? 'selected':'' }}>{{ $name }}</option>
                    @endforeach
                </select>
                @include('layouts.dashboard.form-error', ['key' => 'source_of_study_id'])
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('treatment_urgency_id') ? ' has-error' : '' }}">
            {!! Form::label('treatment_urgency_id',  __('committee::committees.treatment_urgency_id'), ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                <select name="treatment_urgency_id" id="treatment_urgency_id" class="form-control select2">
                    <option value="0">{{ __('committee::committees.please choose') }}</option>
                    @foreach($treatmentUrgency as $id => $name)
                        <option value="{{ $id }}" {{ old('treatment_urgency_id') == $id ? 'selected':'' }}>{{ $name }}</option>
                    @endforeach
                </select>
                @include('layouts.dashboard.form-error', ['key' => 'treatment_urgency_id'])
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('treatment_importance_id') ? ' has-error' : '' }}">
            {!! Form::label('treatment_importance_id',  __('committee::committees.treatment_importance_id'), ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                <select name="treatment_importance_id" id="treatment_importance_id" class="form-control select2">
                    <option value="0">{{ __('committee::committees.please choose') }}</option>
                    @foreach($treatmentImportance as $id => $name)
                        <option value="{{ $id }}" {{ old('treatment_importance_id') == $id ? 'selected':'' }}>{{ $name }}</option>
                    @endforeach
                </select>
                @include('layouts.dashboard.form-error', ['key' => 'treatment_importance_id'])
            </div>
        </div>
    </div>
</div>

<br />

<div class="row">
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('first_meeting_at') ? ' has-error' : '' }}">
            {!! Form::label('first_meeting_at',  __('committee::committees.first_meeting_at'), ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                {!! Form::text('first_meeting_at', null, ['id' => 'first_meeting_at', 'class' => 'form-control date-picker', 'autocomplete' => 'off']) !!}
                @include('layouts.dashboard.form-error', ['key' => 'first_meeting_at'])
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="form-group {{ $errors->has('subject') ? ' has-error' : '' }}">
            {!! Form::label('subject',  __('committee::committees.subject'), ['class' => 'col-md-2 control-label']) !!}

            <div class="col-md-10">
                {!! Form::text('subject', null, ['id' => 'subject', 'class' => 'form-control']) !!}
                @include('layouts.dashboard.form-error', ['key' => 'subject'])
            </div>
        </div>
    </div>
</div>

<br />

<div class="row">
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('president_id') ? ' has-error' : '' }}">
            {!! Form::label('president_id',  __('committee::committees.president_id'), ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                <select name="president_id" id="president_id" class="form-control select2">
                    <option value="0">{{ __('committee::committees.please choose') }}</option>
                    @foreach($studyCommission as $id => $name)
                        <option value="{{ $id }}" {{ old('president_id') == $id ? 'selected':'' }}>{{ $name }}</option>
                    @endforeach
                </select>
                @include('layouts.dashboard.form-error', ['key' => 'president_id'])
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="form-group {{ $errors->has('tasks') ? ' has-error' : '' }}">
            {!! Form::label('tasks',  __('committee::committees.tasks'), ['class' => 'col-md-2 control-label']) !!}

            <div class="col-md-10">
                {!! Form::textArea('tasks', null, ['id' => 'tasks', 'class' => 'form-control', 'rows' => '5']) !!}
                @include('layouts.dashboard.form-error', ['key' => 'tasks'])
            </div>
        </div>
    </div>
</div>

<br />

<div class="row">
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('advisor_id') ? ' has-error' : '' }}">
            {!! Form::label('advisor_id',  __('committee::committees.advisor_id'), ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                <select name="advisor_id" id="advisor_id" class="form-control select2">
                    <option value="0">{{ __('committee::committees.please choose') }}</option>
                    @foreach($presidents as $id => $name)
                        <option value="{{ $id }}" {{ old('advisor_id') == $id ? 'selected':'' }}>{{ $name }}</option>
                    @endforeach
                </select>
                @include('layouts.dashboard.form-error', ['key' => 'advisor_id'])
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group {{ $errors->has('participant_advisors') ? ' has-error' : '' }}">
            {!! Form::label('tasks',  __('committee::committees.participant_advisors'), ['class' => 'col-md-2 control-label']) !!}

            <div class="col-md-10">
                <select name="participant_advisors[]" id="participant_advisors" class="form-control select2" multiple>
                    <option value="0">{{ __('committee::committees.please choose') }}</option>
                    @foreach($presidents as $id => $name)
                        <option value="{{ $id }}"
                                {{ is_array(old('participant_advisors')) && in_array($id, old('participant_advisors')) ? 'selected':'' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
                @include('layouts.dashboard.form-error', ['key' => 'participant_advisors'])
            </div>
        </div>
    </div>
</div>

<br />

<div class="row">
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('members_count') ? ' has-error' : '' }}">
            {!! Form::label('members_count',  __('committee::committees.members_count'), ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                {!! Form::text('members_count', 0, ['id' => 'members_count', 'class' => 'form-control', 'disabled']) !!}
                @include('layouts.dashboard.form-error', ['key' => 'members_count'])
            </div>
        </div>
    </div>
</div>

<hr>

<p class="underLine">{{ __('committee::committees.departments to participate') }}</p>

<div class="row">
    <div class="col-md-4">
        {!! Form::label('tasks',  __('committee::committees.department name'), ['class' => 'col-md-4 control-label']) !!}

        <div class="col-md-8">
            <select id="departments" class="form-control select2">
                <option value="0">{{ __('committee::committees.please choose') }}</option>
                @foreach($departmentsWithRef as $department)
                    <option value="{{ $department->id }}"
                            {{ is_array(old('departments')) && in_array($department->id, old('departments')) ? 'selected':'' }}>
                        {{ ($department->referenceDepartment ? $department->referenceDepartment->name . ' - ':'') . $department->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <button type="button" class="btn btn-primary" id="addDepartmentToParticipants">إضافة</button>
    </div>
</div>

{{-- Departments Table --}}
<div class="row">
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
            </tbody>
        </table>
    </div>
</div>


