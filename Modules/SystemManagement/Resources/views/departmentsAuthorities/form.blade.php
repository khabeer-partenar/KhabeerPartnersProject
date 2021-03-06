<div class="row">

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('main_department_id') ? ' has-error' : '' }}">

            <label for="main_department_id" class="control-label">
                {{ __('systemmanagement::systemmanagement.departmentManagementParentName') }}
                <span style="color: red">*</span>
            </label>

            {!! Form::select('main_department_id', $staffsDepartment, null, ['id' => 'main_department_id', 'class' => 'form_control select2', 'disabled']) !!}

            @if ($errors->has('main_department_id'))
                <span class="help-block" ><strong>{{ $errors->first('main_department_id') }}</strong></span>
            @endif

        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('parent_department_id') ? ' has-error' : '' }}">

            <label for="main_department_id" class="control-label">
                {{ __('systemmanagement::systemmanagement.departmentManagementName') }}
                <span style="color: red">*</span>
            </label>

            {!! Form::select('parent_department_id', $staffExpertsDepartment, null, ['id' => 'parent_department_id', 'class' => 'form_control select2', 'disabled' ]) !!}

            @if ($errors->has('parent_department_id'))
                <span class="help-block" ><strong>{{ $errors->first('parent_department_id') }}</strong></span>
            @endif

        </div>
    </div>

</div>


<br />

<div class="row">

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('department_name') ? ' has-error' : '' }}">

            <label for="department_name" class="control-label">
                {{ __('systemmanagement::systemmanagement.departmentName') }}
                <span style="color: red">*</span>
            </label>

            {!! Form::text('department_name', old('department_name') ?? @$department->name, ['id' => 'department_name', 'class' => 'form_control', 'required' => true]) !!}

            @if ($errors->has('department_name'))
                <span class="help-block" ><strong>{{ $errors->first('department_name') }}</strong></span>
            @endif

        </div>
    </div>

</div>
