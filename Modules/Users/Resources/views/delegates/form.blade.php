<div class="row">

    <div class="col-md-4">
        <div id="div_main_department_id" class="form-group ">

            {!! Form::label('main_department_id', 'نوع الجهة', ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                <select name="main_department_id" id="main_department_id" class="form-control select2 load-departments"
                        data-url="{{ route('system-management.departments.children') }}" data-child="#parent_department_id">
                    <option value="0">{{ __('users::departments.choose a department') }}</option>
                    @php
                        $mainDepartment = isset($delegate) ? $delegate->main_department_id:'';
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
                    <span id="span_main_department_id" class="help-block" ></span>
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div id="div_parent_department_id" class="form-group ">

            {!! Form::label('parent_department_id', 'اسم الجهة', ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                <select name="parent_department_id" id="parent_department_id" class="form-control select2 load-departments change-reference"
                        data-url="{{ route('system-management.departments.children') }}" data-child="#direct_department_id">
                    <option value="0">{{ __('users::departments.choose a department') }}</option>
                    @php
                        $parentDepartment = isset($delegate) ? $delegate->parent_department_id:'';
                        if (old('parent_department_id')){
                            $parentDepartment = old('parent_department_id');
                        }
                    @endphp
                    @foreach(\Modules\SystemManagement\Entities\Department::getParentDepartments($mainDepartment) as $key => $department)
                        <option value="{{ $key }}" {{ $parentDepartment == $key ? 'selected':'' }}>{{ $department }}</option>
                    @endforeach
                </select>

                    <span id="span_parent_department_id" class="help-block" ></span>
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div id="div_department_reference_id" class="form-group ">
            {!! Form::label('department_reference', 'مرجعية الجهة', ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                @php
                    $referenceDepartmentId = isset($delegate) ? $delegate->department_reference_id:'';
                    if (old('department_reference_id')){
                        $referenceDepartmentId = old('department_reference_id');
                    }
                    $referenceDepartment = \Modules\SystemManagement\Entities\Department::find($referenceDepartmentId);
                @endphp
                {!! Form::text('department_reference_val', isset($referenceDepartment) ? $referenceDepartment->name:null, ['id' => 'department_reference_val', 'class' => 'form-control', 'disabled']) !!}
                {!! Form::hidden('department_reference_id', isset($referenceDepartment) ? $referenceDepartment->id:null, ['id' => 'department_reference', 'class' => 'form-control',]) !!}
                    <span id="span_department_reference_id" class="help-block" ></span>
            </div>
        </div>
    </div>

</div>

<br />


<div class="row">

    <div class="col-md-4">
        <div id="div_direct_department_id" class="form-group ">

            {!! Form::label('direct_department_id', 'الإدارة', ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                <select name="direct_department_id" id="direct_department_id" class="form-control select2">
                    <option value="0">{{ __('users::departments.choose a department') }}</option>
                    @php
                        $directDepartment = isset($delegate) ? $delegate->direct_department_id:'';
                        if (old('direct_department_id')){
                            $directDepartment = old('direct_department_id');
                        }
                    @endphp
                    @foreach(\Modules\SystemManagement\Entities\Department::getDirectDepartments($parentDepartment) as $key => $department)
                        <option value="{{ $key }}" {{ $directDepartment == $key ? 'selected':'' }}>{{ $department }}</option>
                    @endforeach
                </select>

                    <span id="span_direct_department_id" class="help-block" ></span>
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div id="div_job_title" class="form-group ">

            {!! Form::label('job_title', 'المسمي الوظيفي', ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                {!! Form::text('job_title', null, ['id' => 'job_title', 'class' => 'form-control']) !!}

                    <span id="span_job_title" class="help-block" ></span>
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div id="div_title" class="form-group ">

            {!! Form::label('title', 'اللقب', ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                {!! Form::text('title', null, ['id' => 'title', 'class' => 'form-control']) !!}

                    <span id="span_title" class="help-block" ></span>
            </div>

        </div>
    </div>
</div>

<br />

<div class="row">
    <div class="col-md-4">
        <div id="div_national_id" class="form-group ">

            {!! Form::label('national_id', 'رقم الهوية', ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                {!! Form::text('national_id', null, ['id' => 'national_id', 'class' => 'form-control']) !!}

                    <span id="span_national_id" class="help-block" ></span>
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div id="div_name" class="form-group ">

            {!! Form::label('name', 'الإسم', ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control']) !!}

                    <span id="span_name" class="help-block" ></span>
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div id="div_phone_number" class="form-group ">

            {!! Form::label('phone_number', 'رقم الجوال', ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                {!! Form::text('phone_number', null, ['id' => 'phone_number', 'class' => 'form-control']) !!}

                    <span id="span_phone_number" class="help-block" ></span>
            </div>

        </div>
    </div>
</div>

<br />

<div class="row">

    <div class="col-md-4">
        <div id="div_email" class="form-group ">

            {!! Form::label('email', 'البريد الإلكتروني', ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                {!! Form::text('email', null, ['id' => 'email', 'class' => 'form-control']) !!}

                    <span id="span_email" class="help-block" ></span>
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div id="div_job_role_id" class="form-group ">

            {!! Form::label('job_role_id', 'الدور الوظيفي', ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                <select id="job_role_id"  class="form-control select2" name="job_role_id" disabled>
                    @php
                        $jobId = isset($delegate) ? $delegate->job_role_id:'';
                        if (old('job_role_id')){
                            $jobId = old('job_role_id');
                        }
                    @endphp
                    @foreach($delegateJobs as $job)
                        <option value="{{ $job->id }}" data-main="{{ $job->key == \Modules\Users\Entities\Delegate::JOB ? '1':'0'}}"
                                {{ $jobId == $job->id ? 'selected':''}}>
                            {{ $job->name }}
                        </option>
                    @endforeach
                </select>

                    <span id="span_job_role_id" class="help-block" ></span>
            </div>

        </div>
    </div>

</div>
