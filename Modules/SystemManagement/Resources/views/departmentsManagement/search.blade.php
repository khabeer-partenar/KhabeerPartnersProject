{{ Form::open(['route' => 'system-management.departments-management.index', 'method' => 'GET']) }}
                
    <div class="form-body">
        
        <div class="row">
            
            <div class="col-md-5">
                <div class="form-group {{ $errors->has('parent_department_id') ? ' has-error' : '' }}">
                
                    {!! Form::label('parent_department_id', __('systemmanagement::systemmanagement.departmentManagementParentName'), ['class' => 'col-md-4 control-label']) !!}
                
                    <div class="col-md-8">
                        {!! Form::select('parent_department_id', $parentDepartmentsData, Request::input('parent_department_id'), ['id' => 'parent_department_id', 'class' => 'form-control select2 load-departments', 'data-url' => route('system-management.departments.children'), 'data-child' => '#main_department_id']) !!}
                    
                        @if ($errors->has('parent_department_id'))
                            <span class="help-block" ><strong>{{ $errors->first('parent_department_id') }}</strong></span>
                        @endif
                    </div>
                
                </div>
            </div>

            <div class="col-md-5">
                <div class="form-group {{ $errors->has('main_department_id') ? ' has-error' : '' }}">
                
                    {!! Form::label('main_department_id', __('systemmanagement::systemmanagement.departmentManagementName'), ['class' => 'col-md-4 control-label']) !!}
                
                    <div class="col-md-8">
                        {!! Form::select('main_department_id', $mainDepartmentsData, Request::input('main_department_id'), ['id' => 'main_department_id', 'class' => 'form-control select2']) !!}
                    
                        @if ($errors->has('main_department_id'))
                            <span class="help-block" ><strong>{{ $errors->first('main_department_id') }}</strong></span>
                        @endif
                    </div>
                
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
    
                    <div class="col-md-12">
                        {{ Form::button(__('messages.search_btn'), ['type' => 'submit', 'class' => 'btn blue col-md-12']) }}
                    </div>
        
                </div>
            </div>

        </div>

    

    </div>

{{ Form::close() }}