{{ Form::open(['route' => 'employees.assign_committees.index', 'method' => 'GET']) }}

    <div class="portlet-body">

        <div class="row">

            <div class="col-md-3">
                <div class="form-group {{ $errors->has('employee_id') ? ' has-error' : '' }}">

                    {!! Form::label('employee_id', __('users::employees.name'), ['class' => 'control-label']) !!}

                    {!! Form::select('employee_id', $employeesIdsData, '', ['id' => 'employee_id', 'class' => 'form_control select2-ajax-search', 'data-ajax--url' => route('employees.assign_committees.search', [$secretaryGroupId, 'name'])]) !!}

                    @if ($errors->has('employee_id'))
                        <span class="help-block" ><strong>{{ $errors->first('employee_id') }}</strong></span>
                    @endif
        
                </div>
            </div>


            <div class="col-md-3">
                <div class="form-group {{ $errors->has('national_id') ? ' has-error' : '' }}">

                    {!! Form::label('national_id', __('users::employees.national_id'), ['class' => 'control-label']) !!}

                    {!! Form::select('national_id', $employeesNationalIdData, '', ['id' => 'national_id', 'class' => 'form_control select2-ajax-search', 'data-ajax--url' => route('employees.assign_committees.search', [$secretaryGroupId, 'national_id'])]) !!}

                    @if ($errors->has('national_id'))
                        <span class="help-block" ><strong>{{ $errors->first('national_id') }}</strong></span>
                    @endif
        
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group {{ $errors->has('employee_email') ? ' has-error' : '' }}">

                    {!! Form::label('employee_email', __('users::employees.email'), ['class' => 'control-label']) !!}

                    {!! Form::select('employee_email', $employeesEmailData, '', ['id' => 'employee_email', 'class' => 'form_control select2-ajax-search', 'data-ajax--url' => route('employees.assign_committees.search', [$secretaryGroupId, 'email'])]) !!}

                    @if ($errors->has('employee_email'))
                        <span class="help-block" ><strong>{{ $errors->first('employee_email') }}</strong></span>
                    @endif
        
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::button(__('messages.search_btn'), ['type' => 'submit', 'class' => 'btn btn-primary_s']) }}
                </div>
            </div>

        </div>


    </div>

{{ Form::close() }}
