{{ Form::open(['route' => 'system-management.departments-management.index', 'method' => 'GET']) }}

    <div class="form-body">

        <div class="row">

            <div class="col-md-5">
                <div class="form-group {{ $errors->has('main_department_id') ? ' has-error' : '' }}">

                    {!! Form::label('main_department_id', __('systemmanagement::systemmanagement.departmentManagementParentName'), ['class' => 'control-label']) !!}

                    {!! Form::select('main_department_id', $mainDepartmentsData, '', ['id' => 'main_department_id', 'class' => 'form_control select2 load-departments', 'data-url' => route('system-management.departments.children'), 'data-child' => '#parent_department_id']) !!}

                    @if ($errors->has('main_department_id'))
                        <span class="help-block" ><strong>{{ $errors->first('main_department_id') }}</strong></span>
                    @endif
    
                </div>
            </div>

            <div class="col-md-5">
                <div class="form-group {{ $errors->has('parent_department_id') ? ' has-error' : '' }}">

                    {!! Form::label('parent_department_id', __('systemmanagement::systemmanagement.departmentManagementName'), ['class' => 'control-label']) !!}

                    {!! Form::select('parent_department_id', $parentDepartmentsData, '', ['id' => 'parent_department_id', 'class' => 'form_control select2']) !!}

                    @if ($errors->has('parent_department_id'))
                        <span class="help-block" ><strong>{{ $errors->first('parent_department_id') }}</strong></span>
                    @endif
        
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    {{ Form::button(__('messages.search_btn'), ['type' => 'submit', 'class' => 'btn btn-primary_s']) }}
                </div>
            </div>

        </div>



    </div>

{{ Form::close() }}
