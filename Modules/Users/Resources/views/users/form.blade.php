<div class="row">
                            
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('main_department_id') ? ' has-error' : '' }}">

            {!! Form::label('main_department_id', __('users::users.department_type'), ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                {!! Form::select('main_department_id', $departmentsDataForForms['staffsDepartments'], null, ['id' => 'main_department_id', 'class' => 'form-control select2', 'disabled']) !!}
                
                @if ($errors->has('main_department_id'))
                    <span class="help-block" ><strong>{{ $errors->first('main_department_id') }}</strong></span>
                @endif
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('parent_department_id') ? ' has-error' : '' }}">

            {!! Form::label('parent_department_id', __('users::users.parent_department_id'), ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                {!! Form::select('parent_department_id', $departmentsDataForForms['staffExpertsDepartments'], null, ['id' => 'parent_department_id', 'class' => 'form-control select2', 'disabled']) !!}
    
                @if ($errors->has('parent_department_id'))
                    <span class="help-block" ><strong>{{ $errors->first('parent_department_id') }}</strong></span>
                @endif
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('direct_department_id') ? ' has-error' : '' }}">

            {!! Form::label('direct_department_id', __('users::users.direct_department_id'), ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                {!! Form::select('direct_department_id', $departmentsDataForForms['directDepartments'], null, ['id' => 'direct_department_id', 'class' => 'form-control select2']) !!}
    
                @if ($errors->has('direct_department_id'))
                    <span class="help-block" ><strong>{{ $errors->first('direct_department_id') }}</strong></span>
                @endif
            </div>

        </div>
    </div>
        
</div>

<br />


<div class="row">
                            
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('national_id') ? ' has-error' : '' }}">

            {!! Form::label('national_id', __('users::users.national_id'), ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                {!! Form::text('national_id', null, ['id' => 'national_id', 'class' => 'form-control']) !!}

                @if ($errors->has('national_id'))
                    <span class="help-block" ><strong>{{ $errors->first('national_id') }}</strong></span>
                @endif
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">

            {!! Form::label('name', __('users::users.name'), ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control']) !!}
    
                @if ($errors->has('name'))
                    <span class="help-block" ><strong>{{ $errors->first('name') }}</strong></span>
                @endif
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('phone_number') ? ' has-error' : '' }}">

            {!! Form::label('phone_number', __('users::users.phone_number'), ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                {!! Form::text('phone_number', null, ['id' => 'phone_number', 'class' => 'form-control']) !!}
    
                @if ($errors->has('phone_number'))
                    <span class="help-block" ><strong>{{ $errors->first('phone_number') }}</strong></span>
                @endif
            </div>

        </div>
    </div>
        
</div>



<br />


<div class="row">
                            
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">

            {!! Form::label('email', __('users::users.email'), ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                {!! Form::text('email', null, ['id' => 'email', 'class' => 'form-control']) !!}

                @if ($errors->has('email'))
                    <span class="help-block" ><strong>{{ $errors->first('email') }}</strong></span>
                @endif
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('job_role_id') ? ' has-error' : '' }}">

            {!! Form::label('job_role_id', __('users::users.job_role_id'), ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                {!! Form::select('job_role_id', $rolesData, null, ['id' => 'job_role_id', 'class' => 'form-control select2']) !!}
    
                @if ($errors->has('job_role_id'))
                    <span class="help-block" ><strong>{{ $errors->first('job_role_id') }}</strong></span>
                @endif
            </div>

        </div>
    </div>


        
</div>