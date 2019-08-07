{{ Form::open(['route' => 'employees.assign_committees.index', 'method' => 'GET']) }}
                
    <div class="portlet-body">
        
        <div class="row">
            
            <div class="col-md-4">
                <div class="form-group {{ $errors->has('employee_id') ? ' has-error' : '' }}">
                
                    {!! Form::label('employee_id', __('users::employees.name'), ['class' => 'col-md-4 control-label']) !!}
                
                    <div class="col-md-8">
                        {!! Form::select('employee_id', $employeesIdsData, Request::input('employee_id'), ['id' => 'employee_id', 'class' => 'form-control select2-ajax-search', 'data-ajax--url' => route('employees.assign_committees.search', [$secretaryGroupId, 'name'])]) !!}
                    
                        @if ($errors->has('employee_id'))
                            <span class="help-block" ><strong>{{ $errors->first('employee_id') }}</strong></span>
                        @endif
                    </div>
                
                </div>
            </div>


            <div class="col-md-4">
                <div class="form-group {{ $errors->has('national_id') ? ' has-error' : '' }}">

                    {!! Form::label('national_id', __('users::employees.national_id'), ['class' => 'col-md-4 control-label']) !!}

                    <div class="col-md-8">
                        {!! Form::select('national_id', $employeesNationalIdData, Request::input('national_id'), ['id' => 'national_id', 'class' => 'form-control select2-ajax-search', 'data-ajax--url' => route('employees.assign_committees.search', [$secretaryGroupId, 'national_id'])]) !!}
            
                        @if ($errors->has('national_id'))
                            <span class="help-block" ><strong>{{ $errors->first('national_id') }}</strong></span>
                        @endif
                    </div>

                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group {{ $errors->has('employee_email') ? ' has-error' : '' }}">

                    {!! Form::label('employee_email', __('users::employees.email'), ['class' => 'col-md-4 control-label']) !!}

                    <div class="col-md-8">
                        {!! Form::select('employee_email', $employeesEmailData, Request::input('employee_email'), ['id' => 'employee_email', 'class' => 'form-control select2-ajax-search', 'data-ajax--url' => route('employees.assign_committees.search', [$secretaryGroupId, 'email'])]) !!}
            
                        @if ($errors->has('employee_email'))
                            <span class="help-block" ><strong>{{ $errors->first('employee_email') }}</strong></span>
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