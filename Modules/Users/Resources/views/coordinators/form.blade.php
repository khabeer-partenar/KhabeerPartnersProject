<div class="row">

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('main_department_id') ? ' has-error' : '' }}">

            <label for="main_department_id" class="col-md-4 control-label">
                نوع الجهة
                <span style="color: red">*</span>
            </label>

            <div class="col-md-8">
                <select name="main_department_id" id="main_department_id" class="form-control select2 load-departments"
                    data-url="{{ route('system-management.departments.children') }}" data-child="#parent_department_id">
                    <option value="0">{{ __('users::departments.choose a department') }}</option>
                    @php
                        $mainDepartment = isset($coordinator) ? $coordinator->main_department_id:'';
                        if (old('main_department_id')){
                            $mainDepartment = old('main_department_id');
                        }
                    @endphp
                    @foreach($mainDepartments as $key => $department)
                        <option value="{{ $key }}" {{ $mainDepartment == $key ? 'selected':'' }}>
                            {{ $department }}
                        </option>
                    @endforeach
                </select>

                @if ($errors->has('main_department_id'))
                    <span class="help-block"><strong>{{ $errors->first('main_department_id') }}</strong></span>
                @endif
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('parent_department_id') ? ' has-error' : '' }}">

            <label for="parent_department_id" class="col-md-4 control-label">
                اسم الجهة
                <span style="color: red">*</span>
            </label>

            <div class="col-md-8">
                <select name="parent_department_id" id="parent_department_id" class="form-control select2 change-reference">
                    <option value="0">{{ __('users::departments.choose a department') }}</option>
                    @php
                        $parentDepartment = isset($coordinator) ? $coordinator->parent_department_id:'';
                        if (old('parent_department_id')){
                            $parentDepartment = old('parent_department_id');
                        }
                    @endphp
                    @foreach(\Modules\SystemManagement\Entities\Department::getParentDepartments($mainDepartment) as $key => $department)
                        <option value="{{ $key }}" {{ $parentDepartment == $key ? 'selected':'' }}>{{ $department }}</option>
                    @endforeach
                </select>

                @if ($errors->has('parent_department_id'))
                    <span class="help-block"><strong>{{ $errors->first('parent_department_id') }}</strong></span>
                @endif
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('department_reference_id') ? ' has-error' : '' }}">
            {!! Form::label('department_reference', 'مرجعية الجهة', ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                @php
                    $referenceDepartmentId = isset($coordinator) ? $coordinator->department_reference_id:'';
                    if (old('department_reference_id')){
                        $referenceDepartmentId = old('department_reference_id');
                    }
                    $referenceDepartment = \Modules\SystemManagement\Entities\Department::find($referenceDepartmentId);
                @endphp
                {!! Form::text('department_reference_val', isset($referenceDepartment) ? $referenceDepartment->name:null, ['id' => 'department_reference_val', 'class' => 'form-control', 'disabled']) !!}
                {!! Form::hidden('department_reference_id', isset($referenceDepartment) ? $referenceDepartment->id:null, ['id' => 'department_reference', 'class' => 'form-control',]) !!}
                @if ($errors->has('department_reference'))
                    <span class="help-block"><strong>{{ $errors->first('department_reference') }}</strong></span>
                @endif
            </div>
        </div>
    </div>

</div>

<br/>


<div class="row">

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('direct_department') ? ' has-error' : '' }}">

            {!! Form::label('direct_department_id', 'الإدارة', ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                {!! Form::text('direct_department', null, ['id' => 'direct_department', 'class' => 'form-control']) !!}

                @if ($errors->has('direct_department'))
                    <span class="help-block" ><strong>{{ $errors->first('direct_department') }}</strong></span>
                @endif
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('job_title') ? ' has-error' : '' }}">

            {!! Form::label('job_title', 'المسمي الوظيفي', ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                {!! Form::text('job_title', null, ['id' => 'job_title', 'class' => 'form-control']) !!}

                @if ($errors->has('job_title'))
                    <span class="help-block"><strong>{{ $errors->first('job_title') }}</strong></span>
                @endif
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">

            {!! Form::label('title', 'اللقب', ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                {!! Form::text('title', null, ['id' => 'title', 'class' => 'form-control']) !!}

                @if ($errors->has('title'))
                    <span class="help-block"><strong>{{ $errors->first('title') }}</strong></span>
                @endif
            </div>

        </div>
    </div>
</div>

<br/>

<div class="row">
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('national_id') ? ' has-error' : '' }}">

            <label for="national_id" class="col-md-4 control-label">
                رقم الهوية
                <span style="color: red">*</span>
            </label>

            <div class="col-md-8">
                {!! Form::text('national_id', null, ['id' => 'national_id', 'class' => 'form-control']) !!}

                @if ($errors->has('national_id'))
                    <span class="help-block"><strong>{{ $errors->first('national_id') }}</strong></span>
                @endif
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">

            <label for="name" class="col-md-4 control-label">
                الإسم
                <span style="color: red">*</span>
            </label>

            <div class="col-md-8">
                {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control']) !!}

                @if ($errors->has('name'))
                    <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                @endif
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('phone_number') ? ' has-error' : '' }}">

            <label for="phone_number" class="col-md-4 control-label">
                رقم الجوال
                <span style="color: red">*</span>
            </label>

            <div class="col-md-8">
                {!! Form::text('phone_number', null, ['id' => 'phone_number', 'class' => 'form-control']) !!}

                @if ($errors->has('phone_number'))
                    <span class="help-block"><strong>{{ $errors->first('phone_number') }}</strong></span>
                @endif
            </div>

        </div>
    </div>
</div>

<br/>

<div class="row">

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">

            <label for="email" class="col-md-4 control-label">
                البريد الإلكتروني
                <span style="color: red">*</span>
            </label>

            <div class="col-md-8">
                {!! Form::text('email', null, ['id' => 'email', 'class' => 'form-control']) !!}

                @if ($errors->has('email'))
                    <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                @endif
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('job_role_id') ? ' has-error' : '' }}">

            {!! Form::label('job_role_id', 'الدور الوظيفي', ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                <select id="job_role_id" class="form-control select2" name="job_role_id" disabled>
                    @php
                        $jobId = isset($coordinator) ? $coordinator->job_role_id:'';
                        if (old('job_role_id')){
                            $jobId = old('job_role_id');
                        }
                    @endphp
                    @foreach($coordinatorJobs as $job)
                        <option value="{{ $job->id }}" data-main="{{ $job->key == \Modules\Users\Entities\Coordinator::MAIN_CO_JOB ? '1':'0'}}"
                            {{ $jobId == $job->id ? 'selected':''}}>
                            {{ $job->name }}
                        </option>
                    @endforeach
                </select>

                @if ($errors->has('job_role_id'))
                    <span class="help-block"><strong>{{ $errors->first('job_role_id') }}</strong></span>
                @endif
            </div>

        </div>
    </div>

</div>
