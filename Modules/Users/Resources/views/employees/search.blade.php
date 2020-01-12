{{ Form::open(['route' => 'employees.index', 'method' => 'GET']) }}

    <div class="portlet-body">

        <div class="row">

            <div class="col-md-3">
                <div class="form-group {{ $errors->has('user_id') ? ' has-error' : '' }}">

                    {!! Form::label('user_id', __('users::employees.name'), ['class' => 'control-label']) !!}
                    {!! Form::select('employee_id', [], $employeesOptions, ['id' => 'employee_id', 'class' => 'form_control select2-search-employees']) !!}

                    @if ($errors->has('employee_id'))
                        <span class="help-block" ><strong>{{ $errors->first('employee_id') }}</strong></span>
                    @endif

                </div>
            </div>


            <div class="col-md-3">
                <div class="form-group {{ $errors->has('direct_department_id') ? ' has-error' : '' }}">

                    {!! Form::label('direct_department_id', __('users::employees.direct_department_id'), ['class' => 'control-label']) !!}
                    {!! Form::select('direct_department_id', $directDepartments, '', ['id' => 'direct_department_id', 'class' => 'form_control select2']) !!}
                
                    @if ($errors->has('direct_department_id'))
                        <span class="help-block" ><strong>{{ $errors->first('direct_department_id') }}</strong></span>
                    @endif

                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group {{ $errors->has('job_role_id') ? ' has-error' : '' }}">

                    {!! Form::label('job_role_id', __('users::employees.job_role_id'), ['class' => 'control-label']) !!}
                    {!! Form::select('job_role_id', $rolesData, '', ['id' => 'job_role_id', 'class' => 'form_control select2']) !!}

                    @if ($errors->has('job_role_id'))
                        <span class="help-block" ><strong>{{ $errors->first('job_role_id') }}</strong></span>
                    @endif
                </div>
            </div>
            
            <div class="col-md-3">
                {{ Form::button(__('messages.search_btn'), ['type' => 'submit', 'class' => 'btn btn-primary_s']) }}
            </div>

        </div>


    </div>

{{ Form::close() }}
