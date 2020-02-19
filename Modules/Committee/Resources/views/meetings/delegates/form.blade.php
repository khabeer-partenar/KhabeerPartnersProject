<div class="row">

    <div class="col-md-4">
        <div id="div_main_department_id" class="form-group {{ $errors->has('main_department_id') ? ' has-error' : '' }}">
            <label for="main_department_id" class="control-label">
                نوع الجهة
                <span style="color: red">*</span>
            </label>


                <select name="main_department_id" id="main_department_id"
                        class="form_control select2 load-departments"
                        data-url="{{ route('system-management.departments.children') }}"
                        data-child="#parent_department_id">
                    <option value="0">{{ __('users::departments.choose a department') }}</option>


                        <option value="">
                        </option>
                </select>

                @if ($errors->has('main_department_id'))
                    <span class="help-block"><strong>{{ $errors->first('main_department_id') }}</strong></span>
                @endif

        </div>
    </div>

    <div class="col-md-4">
        <div id="div_parent_department_id" class="form-group {{ $errors->has('parent_department_id') ? ' has-error' : '' }}">

            <label for="parent_department_id" class="control-label">
                اسم الجهة
                <span style="color: red">*</span>
            </label>

                <select  name="parent_department_id" id="parent_department_id"
                        class="form_control select2 load-departments change-reference"
                        data-url="{{ route('system-management.departments.children') }}"
                        data-child="#direct_department_id">
                    <option value="0">{{ __('users::departments.choose a department') }}</option>

                        <option value=""></option>
                </select>

                @if ($errors->has('parent_department_id'))
                    <span class="help-block"><strong>{{ $errors->first('parent_department_id') }}</strong></span>
                @endif

        </div>
    </div>



</div>

<br/>


<div class="row">

    <div class="col-md-4">
        <div id="div_direct_department" class="form-group {{ $errors->has('direct_department') ? ' has-error' : '' }}">
            {!! Form::label('direct_department_id', 'الإدارة', ['class' => 'control-label']) !!}
                {!! Form::text('direct_department', null, ['id' => 'direct_department', 'class' => 'form_control']) !!}
                @if ($errors->has('direct_department'))
                    <span class="help-block" ><strong>{{ $errors->first('direct_department') }}</strong></span>
                @endif

        </div>
    </div>

    <div class="col-md-4">
        <div id="div_job_title" class="form-group {{ $errors->has('job_title') ? ' has-error' : '' }}">

            {!! Form::label('job_title', 'المسمي الوظيفي', ['class' => 'control-label']) !!}
            <label style="position: absolute;text-align: center;font-size: large; color: #e32;display:inline;">*</label>

                {!! Form::text('job_title', null, ['id' => 'job_title', 'class' => 'form_control']) !!}

                @if ($errors->has('job_title'))
                    <span class="help-block"><strong>{{ $errors->first('job_title') }}</strong></span>
                @endif

        </div>
    </div>
    <div class="col-md-4">
        <div id="div_specialty" class="form-group {{ $errors->has('specialty') ? ' has-error' : '' }}">

            {!! Form::label('specialty', 'الاختصاص', ['class' => 'control-label']) !!}

                {!! Form::text('specialty', null, ['id' => 'specialty', 'class' => 'form_control']) !!}

                @if ($errors->has('specialty'))
                    <span class="help-block"><strong>{{ $errors->first('specialty') }}</strong></span>
                @endif

        </div>
    </div>

</div>

<br/>

<div class="row">
    <div class="col-md-4">
        <div id="div_national_id" class="form-group {{ $errors->has('national_id') ? ' has-error' : '' }}">

            {!! Form::label('national_id', 'رقم الهوية', ['class' => 'control-label']) !!}
            <label style="position: absolute;text-align: center;font-size: large; color: #e32;display:inline;">*</label>

                {!! Form::text('national_id', null, ['id' => 'national_id',"onkeyup" => "this.value=this.value.replace(/[^\d]/,'')", 'class' => 'form_control','maxlength' => 10]) !!}

                @if ($errors->has('national_id'))
                    <span class="help-block"><strong>{{ $errors->first('national_id') }}</strong></span>
                @endif

        </div>
    </div>

    <div class="col-md-4">
        <div id="div_name" class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
            <input type="hidden" id="driverid" name="driver_id">
            {!! Form::label('name', 'الإسم', ['class' => 'control-label']) !!}
            <label style="position: absolute;text-align: center;font-size: large; color: #e32;display:inline;">*</label>

                {!! Form::text('name', null, ['id' => 'name', 'class' => 'form_control']) !!}

                @if ($errors->has('name'))
                    <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                @endif

        </div>
    </div>

    <div class="col-md-4">
        <div id="div_phone_number" class="form-group {{ $errors->has('phone_number') ? ' has-error' : '' }}">

            {!! Form::label('phone_number', 'رقم الجوال', ['class' => 'control-label']) !!}
            <label style="position: absolute;text-align: center;font-size: large; color: #e32;display:inline;">*</label>

                {!! Form::text('phone_number', null, ['id' => 'phone_number',"onkeyup" => "this.value=this.value.replace(/[^\d]/,'')", 'class' => 'form_control','maxlength' => 10]) !!}

                @if ($errors->has('phone_number'))
                    <span class="help-block"><strong>{{ $errors->first('phone_number') }}</strong></span>
                @endif

        </div>
    </div>
</div>

<br/>

<div class="row">

    <div class="col-md-4">
        <div id="div_email" class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">

            {!! Form::label('email', 'البريد الإلكتروني', ['class' => 'control-label']) !!}
            <label style="position: absolute;text-align: center;font-size: large; color: #e32;display:inline;">*</label>

                {!! Form::text('email', null, ['id' => 'email', 'class' => 'form_control']) !!}

                @if ($errors->has('email'))
                    <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                @endif

        </div>
    </div>
    <div class="col-md-4">
        <div id="div_title" class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">

            {!! Form::label('title', 'اللقب', ['class' => 'control-label']) !!}

                {!! Form::text('title', null, ['id' => 'title', 'class' => 'form_control']) !!}

                @if ($errors->has('title'))
                    <span class="help-block"><strong>{{ $errors->first('title') }}</strong></span>
                @endif

        </div>
    </div>
    <div class="col-md-4">
        <div id="div_job_role_id" class="form-group ">


                <select id="job_role_id" class="form_control select2" name="job_role_id" disabled>


                        <option value="{{ $job->id }}"
                                data-main="">
                            ''
                        </option>

                </select>

                @if ($errors->has('job_role_id'))
                    <span class="help-block"><strong>{{ $errors->first('job_role_id') }}</strong></span>
                @endif

        </div>
    </div>

</div>
