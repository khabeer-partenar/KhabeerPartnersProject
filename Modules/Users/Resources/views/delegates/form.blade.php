<div class="row">

    <div class="col-md-4">
        <div id="div_main_department_id" class="form-group ">
            {!! Form::label('main_department_id', 'نوع الجهة', ['class' => 'col-md-4 control-label']) !!}
            <label style="position: absolute;text-align: center;font-size: large; color: #e32;display:inline;">*</label>

            <div class="col-md-8">
                @php
                    $mainDepartment = 0;
                        if (auth()->user()->authorizedApps->key == \Modules\Users\Entities\Coordinator::NORMAL_CO_JOB)
                        {
                            $mainDepartment = auth()->user()->main_department_id;
                        }
                @endphp

                <select {{$mainDepartment!=0?'disabled':''}} name="main_department_id" id="main_department_id"
                        class="form_control select2 load-departments"
                        data-url="{{ route('system-management.departments.children') }}"
                        data-child="#parent_department_id">
                    <option value="0">{{ __('users::departments.choose a department') }}</option>

                    @foreach($mainDepartments as $key => $department)
                        <option value="{{ $key }}" {{ $mainDepartment == $key ? 'selected':'' }}>
                            {{ $department }}
                        </option>
                    @endforeach
                </select>

                <span id="span_main_department_id" class="help-block span-error"></span>
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div id="div_parent_department_id" class="form-group ">

            {!! Form::label('parent_department_id', 'اسم الجهة', ['class' => 'col-md-4 control-label']) !!}
            <label style="position: absolute;text-align: center;font-size: large; color: #e32;display:inline;">*</label>
            <div class="col-md-8">
                @php
                    $parentDepartment = 0;
                        if (auth()->user()->authorizedApps->key == \Modules\Users\Entities\Coordinator::NORMAL_CO_JOB)
                        {
                            $parentDepartment = auth()->user()->parent_department_id;
                        }
                @endphp

                <select {{$parentDepartment!=0?'disabled':''}} name="parent_department_id" id="parent_department_id"
                        class="form_control select2 load-departments change-reference"
                        data-url="{{ route('system-management.departments.children') }}"
                        data-child="#direct_department_id">
                    <option value="0">{{ __('users::departments.choose a department') }}</option>

                    @foreach(\Modules\SystemManagement\Entities\Department::getParentDepartments($mainDepartment) as $key => $department)
                        <option value="{{ $key }}" {{ $parentDepartment == $key ? 'selected':'' }}>{{ $department }}</option>
                    @endforeach
                </select>

                <span id="span_parent_department_id" class="help-block span-error"></span>
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
                {!! Form::text('department_reference_val', isset($referenceDepartment) ? $referenceDepartment->name:null, ['id' => 'department_reference_val', 'class' => 'form_control', 'disabled']) !!}
                {!! Form::hidden('department_reference_id', isset($referenceDepartment) ? $referenceDepartment->id:null, ['id' => 'department_reference', 'class' => 'form_control',]) !!}
                <span id="span_department_reference_id" class="help-block span-error"></span>
            </div>
        </div>
    </div>

</div>

<br/>


<div class="row">

    <div class="col-md-4">
        <div id="div_direct_department" class="form-group ">
            {!! Form::label('direct_department_id', 'الإدارة', ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-8">
                {!! Form::text('direct_department', null, ['id' => 'direct_department', 'class' => 'form_control']) !!}
                <span id="span_job_title" class="help-block span-error"></span>
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div id="div_job_title" class="form-group ">

            {!! Form::label('job_title', 'المسمي الوظيفي', ['class' => 'col-md-4 control-label']) !!}
            <label style="position: absolute;text-align: center;font-size: large; color: #e32;display:inline;">*</label>

            <div class="col-md-8">
                {!! Form::text('job_title', null, ['id' => 'job_title', 'class' => 'form_control']) !!}

                <span id="span_job_title" class="help-block span-error"></span>
            </div>

        </div>
    </div>
    <div class="col-md-4">
        <div id="div_job_title" class="form-group ">

            {!! Form::label('specialty', 'الاختصاص', ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                {!! Form::text('specialty', null, ['id' => 'specialty', 'class' => 'form_control']) !!}

                <span id="span_job_title" class="help-block span-error"></span>
            </div>

        </div>
    </div>

</div>

<br/>

<div class="row">
    <div class="col-md-4">
        <div id="div_national_id" class="form-group ">

            {!! Form::label('national_id', 'رقم الهوية', ['class' => 'col-md-4 control-label']) !!}
            <label style="position: absolute;text-align: center;font-size: large; color: #e32;display:inline;">*</label>

            <div class="col-md-8">
                {!! Form::text('national_id', null, ['id' => 'national_id',"onkeyup" => "this.value=this.value.replace(/[^\d]/,'')", 'class' => 'form_control','maxlength' => 10]) !!}

                <span id="span_national_id" class="help-block span-error"></span>
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div id="div_name" class="form-group ">

            {!! Form::label('name', 'الإسم', ['class' => 'col-md-4 control-label']) !!}
            <label style="position: absolute;text-align: center;font-size: large; color: #e32;display:inline;">*</label>

            <div class="col-md-8">
                {!! Form::text('name', null, ['id' => 'name', 'class' => 'form_control']) !!}

                <span id="span_name" class="help-block span-error"></span>
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div id="div_phone_number" class="form-group ">

            {!! Form::label('phone_number', 'رقم الجوال', ['class' => 'col-md-4 control-label']) !!}
            <label style="position: absolute;text-align: center;font-size: large; color: #e32;display:inline;">*</label>

            <div class="col-md-8">
                {!! Form::text('phone_number', null, ['id' => 'phone_number',"onkeyup" => "this.value=this.value.replace(/[^\d]/,'')", 'class' => 'form_control','maxlength' => 10]) !!}

                <span id="span_phone_number" class="help-block span-error"></span>
            </div>

        </div>
    </div>
</div>

<br/>

<div class="row">

    <div class="col-md-4">
        <div id="div_email" class="form-group ">

            {!! Form::label('email', 'البريد الإلكتروني', ['class' => 'col-md-4 control-label']) !!}
            <label style="position: absolute;text-align: center;font-size: large; color: #e32;display:inline;">*</label>

            <div class="col-md-8">
                {!! Form::text('email', null, ['id' => 'email', 'class' => 'form_control']) !!}

                <span id="span_email" class="help-block span-error"></span>
            </div>

        </div>
    </div>
    <div class="col-md-4">
        <div id="div_title" class="form-group ">

            {!! Form::label('title', 'اللقب', ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                {!! Form::text('title', null, ['id' => 'title', 'class' => 'form_control']) !!}

                <span id="span_title" class="help-block span-error"></span>
            </div>

        </div>
    </div>
    <div class="col-md-4">
        <div id="div_job_role_id" class="form-group ">

            {!! Form::label('job_role_id', 'الدور الوظيفي', ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                <select id="job_role_id" class="form_control select2" name="job_role_id" disabled>
                    @php
                        $jobId = isset($delegate) ? $delegate->job_role_id:'';
                        if (old('job_role_id')){
                            $jobId = old('job_role_id');
                        }
                    @endphp
                    @foreach($delegateJobs as $job)
                        <option value="{{ $job->id }}"
                                data-main="{{ $job->key == \Modules\Users\Entities\Delegate::JOB ? '1':'0'}}"
                                {{ $jobId == $job->id ? 'selected':''}}>
                            {{ $job->name }}
                        </option>
                    @endforeach
                </select>

                <span id="span_job_role_id" class="help-block span-error"></span>
            </div>

        </div>
    </div>

</div>