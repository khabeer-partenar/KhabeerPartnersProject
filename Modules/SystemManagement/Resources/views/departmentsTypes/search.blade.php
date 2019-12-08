{{ Form::open(['route' => 'system-management.departments-types.index', 'method' => 'GET']) }}

    <div class="form-body">

        <div class="row">

            <div class="col-md-10">
                <div class="form-group {{ $errors->has('department_id') ? ' has-error' : '' }}">

                    {!! Form::label('department_id', __('systemmanagement::systemmanagement.department'), ['class' => 'col-md-2 control-label']) !!}

                    <div class="col-md-10">
                        {!! Form::select('department_id', $mainDepartmentsData, '', ['id' => 'department_id', 'class' => 'form_control select2']) !!}

                        @if ($errors->has('department_id'))
                            <span class="help-block" ><strong>{{ $errors->first('department_id') }}</strong></span>
                        @endif
                    </div>

                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">

                    <div class="col-md-12">
                        {{ Form::button(__('messages.search_btn'), ['type' => 'submit', 'class' => 'btn btn-default col-md-12']) }}
                    </div>

                </div>
            </div>

        </div>



    </div>

{{ Form::close() }}
