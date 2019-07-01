<div class="row">
                                
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('dept_name') ? ' has-error' : '' }}">
    
            {!! Form::label('dept_name', __('systemmanagement::systemmanagement.deptName'), ['class' => 'col-md-2 control-label']) !!}
    
                <div class="col-md-10">
                {!! Form::text('dept_name', null, ['id' => 'dept_name', 'class' => 'form-control']) !!}

                @if ($errors->has('dept_name'))
                    <span class="help-block" ><strong>{{ $errors->first('dept_name') }}</strong></span>
                @endif
            </div>
    
        </div>
    </div>
    
</div>