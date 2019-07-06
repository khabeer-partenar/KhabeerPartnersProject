<div class="row">
                                
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
    
            {!! Form::label('name', __('systemmanagement::systemmanagement.deptName'), ['class' => 'col-md-2 control-label']) !!}
    
                <div class="col-md-10">
                {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control']) !!}

                @if ($errors->has('name'))
                    <span class="help-block" ><strong>{{ $errors->first('name') }}</strong></span>
                @endif
            </div>
    
        </div>
    </div>
    
</div>