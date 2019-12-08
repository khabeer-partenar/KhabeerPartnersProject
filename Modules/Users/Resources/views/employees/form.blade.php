<div class="row">

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('main_department_id') ? ' has-error' : '' }}">

            <label for="main_department_id" class="control-label">
                {{ __('users::employees.department_type') }}
                <span style="color: red">*</span>
            </label>

            {!! Form::select('main_department_id', $departmentsDataForForms['staffsDepartments'], null, ['id' => 'main_department_id', 'class' => 'form_control select2', 'disabled']) !!}

            @if ($errors->has('main_department_id'))
                <span class="help-block" ><strong>{{ $errors->first('main_department_id') }}</strong></span>
            @endif

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('parent_department_id') ? ' has-error' : '' }}">

            <label for="parent_department_id" class="control-label">
                {{ __('users::employees.parent_department_id') }}
                <span style="color: red">*</span>
            </label>

            {!! Form::select('parent_department_id', $departmentsDataForForms['staffExpertsDepartments'], null, ['id' => 'parent_department_id', 'class' => 'form_control select2', 'disabled']) !!}

            @if ($errors->has('parent_department_id'))
                <span class="help-block" ><strong>{{ $errors->first('parent_department_id') }}</strong></span>
            @endif

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('direct_department_id') ? ' has-error' : '' }}">

            <label for="direct_department_id" class="control-label">
                {{ __('users::employees.direct_department_id') }}
                <span style="color: red">*</span>
            </label>

            {!! Form::select('direct_department_id', $departmentsDataForForms['directDepartments'], null, ['id' => 'direct_department_id', 'class' => 'form_control select2', 'required' => true]) !!}

            @if ($errors->has('direct_department_id'))
                <span class="help-block" ><strong>{{ $errors->first('direct_department_id') }}</strong></span>
            @endif

        </div>
    </div>

</div>

<br />


<div class="row">

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('national_id') ? ' has-error' : '' }}">

            <label for="national_id" class="control-label">
                {{ __('users::employees.national_id') }}
                <span style="color: red">*</span>
            </label>

            {!! Form::number('national_id', null, ['id' => 'national_id', 'class' => 'form_control', 'min' => '1000000000', 'max' => '1999999999', 'required' => true]) !!}

            @if ($errors->has('national_id'))
                <span class="help-block" ><strong>{{ $errors->first('national_id') }}</strong></span>
            @endif

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">

            <label for="name" class="control-label">
                {{ __('users::employees.name') }}
                <span style="color: red">*</span>
            </label>

            {!! Form::text('name', null, ['id' => 'name', 'class' => 'form_control', 'required' => true]) !!}

            @if ($errors->has('name'))
                <span class="help-block" ><strong>{{ $errors->first('name') }}</strong></span>
            @endif
            
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('phone_number') ? ' has-error' : '' }}">

            <label for="phone_number" class="control-label">
                {{ __('users::employees.phone_number') }}
                <span style="color: red">*</span>
            </label>

            {!! Form::number('phone_number', null, ['id' => 'phone_number', 'class' => 'form_control', 'min' => '0500000000', 'max' => '0599999999', 'required' => true]) !!}

            @if ($errors->has('phone_number'))
                <span class="help-block" ><strong>{{ $errors->first('phone_number') }}</strong></span>
            @endif

        </div>
    </div>

</div>



<br />


<div class="row">

    <div class="col-md-8">
        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">

            <label for="email" class="control-label">
                {{ __('users::employees.email') }}
                <span style="color: red">*</span>
            </label>

            {!! Form::text('email', null, ['id' => 'email', 'class' => 'form_control', 'required' => true]) !!}

            @if ($errors->has('email'))
                <span class="help-block" ><strong>{{ $errors->first('email') }}</strong></span>
            @endif

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('job_role_id') ? ' has-error' : '' }}">

            <label for="job_role_id" class="control-label">
                {{ __('users::employees.job_role_id') }}
                <span style="color: red">*</span>
            </label>

            {!! Form::select('job_role_id', $rolesData, null, ['id' => 'job_role_id', 'class' => 'form_control select2', 'required' => true]) !!}

            @if ($errors->has('job_role_id'))
                <span class="help-block" ><strong>{{ $errors->first('job_role_id') }}</strong></span>
            @endif

        </div>
    </div>



</div>
