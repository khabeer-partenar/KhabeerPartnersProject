{{ Form::open(['route' => 'system-management.departmentsTypes', 'method' => 'GET']) }}
                
    <div class="form-body">
        
        <div class="row">
            
            <div class="col-md-10">
                <div class="form-group {{ $errors->has('user_id') ? ' has-error' : '' }}">
                
                    {!! Form::label('user_id', __('systemmanagement::systemmanagement.department'), ['class' => 'col-md-2 control-label']) !!}
                
                    <div class="col-md-10">
                        {!! Form::select('parent_department_id', [], Request::input('parent_department_id'), ['id' => 'parent_department_id', 'class' => 'form-control select2-ajax-search', 'data-ajax--url' => route('system-management.search', 'parent')]) !!}
                    
                        @if ($errors->has('parent_department_id'))
                            <span class="help-block" ><strong>{{ $errors->first('parent_department_id') }}</strong></span>
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