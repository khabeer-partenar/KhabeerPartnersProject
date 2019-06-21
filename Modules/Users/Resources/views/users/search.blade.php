{{ Form::open(['route' => 'users.index', 'method' => 'GET']) }}
                
    <div class="form-body">
        
        <div class="row">
            
            <div class="col-md-4">
                <div class="form-group {{ $errors->has('user_id') ? ' has-error' : '' }}">
                
                    {!! Form::label('user_id', __('users::users.name'), ['class' => 'col-md-4 control-label']) !!}
                
                    <div class="col-md-8">
                        {!! Form::select('user_id', [], null, ['id' => 'user_id', 'class' => 'form-control select2-search-users']) !!}
                    
                        @if ($errors->has('user_id'))
                            <span class="help-block" ><strong>{{ $errors->first('user_id') }}</strong></span>
                        @endif
                    </div>
                
                </div>
            </div>


            <div class="col-md-4">
                <div class="form-group {{ $errors->has('direct_department_id') ? ' has-error' : '' }}">

                    {!! Form::label('direct_department_id', __('users::users.direct_department_id'), ['class' => 'col-md-4 control-label']) !!}

                    <div class="col-md-8">
                        {!! Form::select('direct_department_id', $directDepartments, null, ['id' => 'direct_department_id', 'class' => 'form-control select2']) !!}
            
                        @if ($errors->has('direct_department_id'))
                            <span class="help-block" ><strong>{{ $errors->first('direct_department_id') }}</strong></span>
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

        <br/>

        <div class="row">
            
            <div class="col-md-8">
            </div>
    
            <div class="col-md-4">
                <div class="form-group {{ $errors->has('job_role_id') ? ' has-error' : '' }}">
    
                    <div class="col-md-4"></div>
    
                    <div class="col-md-8">
                        {{ Form::button(__('messages.search_btn'), ['type' => 'submit', 'class' => 'btn blue col-md-12']) }}
                    </div>
    
                </div>
            </div>
    
        </div>
    

    </div>

{{ Form::close() }}