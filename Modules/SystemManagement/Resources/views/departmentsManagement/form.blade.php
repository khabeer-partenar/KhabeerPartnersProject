<div class="row">
                                
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('parent_id') ? ' has-error' : '' }}">
        
            {!! Form::label('parent_id', __('systemmanagement::systemmanagement.departmentManagementParentName'), ['class' => 'col-md-4 control-label']) !!}
        
            <div class="col-md-8">
                {!! Form::select('parent_id', $parentDepartmentsData, null, ['id' => 'parent_id', 'class' => 'form-control select2']) !!}
            
                @if ($errors->has('parent_id'))
                    <span class="help-block" ><strong>{{ $errors->first('parent_id') }}</strong></span>
                @endif
            </div>
        
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
        
            {!! Form::label('name', __('systemmanagement::systemmanagement.departmentManagementName'), ['class' => 'col-md-4 control-label']) !!}
        
            <div class="col-md-8">
                {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control']) !!}
            
                @if ($errors->has('name'))
                    <span class="help-block" ><strong>{{ $errors->first('name') }}</strong></span>
                @endif
            </div>
        
        </div>
    </div>
    
</div>


<br />

<div class="row">
                                
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('telephone') ? ' has-error' : '' }}">
        
            {!! Form::label('telephone', __('systemmanagement::systemmanagement.departmentManagementTelephone'), ['class' => 'col-md-4 control-label']) !!}
        
            <div class="col-md-8">
                {!! Form::text('telephone', null, ['id' => 'telephone', 'class' => 'form-control']) !!}
            
                @if ($errors->has('telephone'))
                    <span class="help-block" ><strong>{{ $errors->first('telephone') }}</strong></span>
                @endif
            </div>
        
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
        
            {!! Form::label('address', __('systemmanagement::systemmanagement.departmentManagementAddress'), ['class' => 'col-md-4 control-label']) !!}
        
            <div class="col-md-8">
                {!! Form::text('address', null, ['id' => 'address', 'class' => 'form-control']) !!}
            
                @if ($errors->has('address'))
                    <span class="help-block" ><strong>{{ $errors->first('address') }}</strong></span>
                @endif
            </div>
        
        </div>
    </div>
    
</div>

<br />

<div class="row">
                                
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
        
            {!! Form::label('email', __('systemmanagement::systemmanagement.departmentManagementEmail'), ['class' => 'col-md-4 control-label']) !!}
        
            <div class="col-md-8">
                {!! Form::text('email', null, ['id' => 'email', 'class' => 'form-control']) !!}
            
                @if ($errors->has('email'))
                    <span class="help-block" ><strong>{{ $errors->first('email') }}</strong></span>
                @endif
            </div>
        
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('is_reference') ? ' has-error' : '' }}">
        
            {!! Form::label('is_reference', __('systemmanagement::systemmanagement.departmentManagementIsReference'), ['class' => 'col-md-4 control-label']) !!}
        
            <div class="col-md-8">
                {!! Form::checkbox('is_reference', 1, null, ['id' => 'is_reference']) !!}
            
                @if ($errors->has('is_reference'))
                    <span class="help-block" ><strong>{{ $errors->first('is_reference') }}</strong></span>
                @endif
            </div>
        
        </div>
    </div>
    
</div>