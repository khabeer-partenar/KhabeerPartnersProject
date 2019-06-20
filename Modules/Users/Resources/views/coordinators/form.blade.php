<div class="row">
                            
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('main_department_id') ? ' has-error' : '' }}">

            {!! Form::label('main_department_id', 'نوع الجهة', ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                <select name="main_department_id" id="main_department_id" class="form-control select2 load-departments"
                    data-url="{{ route('departments.children') }}" data-child="#parent_department_id">
                    <option value="0">{{ __('users::departments.choose a department') }}</option>
                    @foreach($mainDepartments as $key => $department)
                        <option value="{{ $key }}" {{ old('main_department_id') == $key ? 'selected':'' }}>{{ $department }}</option>
                    @endforeach
                </select>
                
                @if ($errors->has('main_department_id'))
                    <span class="help-block" ><strong>{{ $errors->first('main_department_id') }}</strong></span>
                @endif
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('parent_department_id') ? ' has-error' : '' }}">

            {!! Form::label('parent_department_id', 'اسم الجهة', ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                <select name="parent_department_id" id="parent_department_id" class="form-control select2 load-departments"
                        data-url="{{ route('departments.children') }}" data-child="#direct_department_id">
                    <option value="0">{{ __('users::departments.choose a department') }}</option>
                    @if(old('parent_department_id') && old('main_department_id'))
                        @php $parentDepartments = \Modules\Users\Entities\Department::getParentDepartments(old('main_department_id')) @endphp
                        @foreach($parentDepartments as $key => $department)
                            <option value="{{ $key }}" {{ old('parent_department_id') == $key ? 'selected':'' }}>{{ $department }}</option>
                        @endforeach
                    @endif
                </select>

                @if ($errors->has('parent_department_id'))
                    <span class="help-block" ><strong>{{ $errors->first('parent_department_id') }}</strong></span>
                @endif
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('direct_department_id') ? ' has-error' : '' }}">

            {!! Form::label('direct_department_id', 'الإدارة', ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                <select name="direct_department_id" id="direct_department_id" class="form-control select2 load-departments">
                    <option value="0">{{ __('users::departments.choose a department') }}</option>
                    @if(old('parent_department_id') && old('main_department_id'))
                        @php $directDepartments = \Modules\Users\Entities\Department::getDirectDepartments(old('parent_department_id')) @endphp
                        @foreach($directDepartments as $key => $department)
                            <option value="{{ $key }}" {{ old('direct_department_id') == $key ? 'selected':'' }}>{{ $department }}</option>
                        @endforeach
                    @endif
                </select>



                @if ($errors->has('direct_department_id'))
                    <span class="help-block" ><strong>{{ $errors->first('direct_department_id') }}</strong></span>
                @endif
            </div>

        </div>
    </div>
        
</div>

<br />


<div class="row">
                            
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('national_id') ? ' has-error' : '' }}">

            {!! Form::label('national_id', 'رقم الهوية', ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                {!! Form::text('national_id', null, ['id' => 'national_id', 'class' => 'form-control']) !!}

                @if ($errors->has('national_id'))
                    <span class="help-block" ><strong>{{ $errors->first('national_id') }}</strong></span>
                @endif
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">

            {!! Form::label('name', 'الإسم', ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control']) !!}
    
                @if ($errors->has('name'))
                    <span class="help-block" ><strong>{{ $errors->first('name') }}</strong></span>
                @endif
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('phone_number') ? ' has-error' : '' }}">

            {!! Form::label('phone_number', 'رقم الجوال', ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                {!! Form::text('phone_number', null, ['id' => 'phone_number', 'class' => 'form-control']) !!}
    
                @if ($errors->has('phone_number'))
                    <span class="help-block" ><strong>{{ $errors->first('phone_number') }}</strong></span>
                @endif
            </div>

        </div>
    </div>
        
</div>



<br />


<div class="row">
                            
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">

            {!! Form::label('email', 'البريد الإلكتروني', ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                {!! Form::text('email', null, ['id' => 'email', 'class' => 'form-control']) !!}

                @if ($errors->has('email'))
                    <span class="help-block" ><strong>{{ $errors->first('email') }}</strong></span>
                @endif
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('job_role_id') ? ' has-error' : '' }}">

            {!! Form::label('job_role_id', 'الدور الوظيفي', ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                {!! Form::select('job_role_id', $coordinator, null, ['id' => 'job_role_id', 'class' => 'form-control select2', 'disabled']) !!}
    
                @if ($errors->has('job_role_id'))
                    <span class="help-block" ><strong>{{ $errors->first('job_role_id') }}</strong></span>
                @endif
            </div>

        </div>
    </div>

</div>