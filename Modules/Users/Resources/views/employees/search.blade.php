{{ Form::open(['route' => 'employees.index', 'method' => 'GET']) }}
                
    <div class="portlet-body">
        
        <div class="row">
            
            <div class="col-md-4">
                <div class="form-group {{ $errors->has('user_id') ? ' has-error' : '' }}">
                
                    {!! Form::label('user_id', __('users::employees.name'), ['class' => 'col-md-4 control-label']) !!}
                
                    <div class="col-md-8">
                        {!! Form::select('employee_id', $employeesData, Request::input('employee_id'), ['id' => 'employee_id', 'class' => 'form-control select2-search-employees']) !!}
                    
                        @if ($errors->has('employee_id'))
                            <span class="help-block" ><strong>{{ $errors->first('employee_id') }}</strong></span>
                        @endif
                    </div>
                
                </div>
            </div>


            <div class="col-md-4">
                <div class="form-group {{ $errors->has('direct_department_id') ? ' has-error' : '' }}">

                    {!! Form::label('direct_department_id', __('users::employees.direct_department_id'), ['class' => 'col-md-4 control-label']) !!}

                    <div class="col-md-8">
                        {!! Form::select('direct_department_id', $directDepartments, Request::input('direct_department_id'), ['id' => 'direct_department_id', 'class' => 'form-control select2']) !!}
            
                        @if ($errors->has('direct_department_id'))
                            <span class="help-block" ><strong>{{ $errors->first('direct_department_id') }}</strong></span>
                        @endif
                    </div>

                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group {{ $errors->has('job_role_id') ? ' has-error' : '' }}">

                    {!! Form::label('job_role_id', __('users::employees.job_role_id'), ['class' => 'col-md-4 control-label']) !!}

                    <div class="col-md-8">
                        {!! Form::select('job_role_id', $rolesData, Request::input('job_role_id'), ['id' => 'job_role_id', 'class' => 'form-control select2']) !!}
            
                        @if ($errors->has('job_role_id'))
                            <span class="help-block" ><strong>{{ $errors->first('job_role_id') }}</strong></span>
                        @endif
                    </div>

                </div>
            </div>

        </div>

        <br/>



        <div class="row">
            
            <div class="col-md-8">
            </div>
    
            <div class="col-md-4">
                <div class="form-group">
    
                    <div class="col-md-4"></div>
    
                    <div class="col-md-8">
                        {{ Form::button(__('messages.search_btn'), ['type' => 'submit', 'class' => 'btn btn-default col-md-12']) }}
                    </div>
    
                </div>
            </div>
    
        </div>
    

    </div>

{{ Form::close() }}