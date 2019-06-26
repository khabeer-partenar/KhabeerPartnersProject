<div class="row">

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('main_department_id') ? ' has-error' : '' }}">

            {!! Form::label('main_department_id', 'نوع الجهة', ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                <select disabled name="main_department_id" id="main_department_id" class="form-control select2">
                    @php $mainDepartment = auth()->user()->main_department_id @endphp
                    @foreach($mainDepartments as $key => $department)
                        <option value="{{ $key }}" {{ $mainDepartment == $key ? 'selected':'' }}>
                            {{ $department }}
                        </option>
                    @endforeach
                </select>
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('parent_department_id') ? ' has-error' : '' }}">

            {!! Form::label('parent_department_id', 'اسم الجهة', ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                <select disabled name="parent_department_id" id="parent_department_id" class="form-control select2">
                    @php $parentDepartment = auth()->user()->parent_department_id; @endphp
                    @foreach(\Modules\SystemManagement\Entities\Department::getParentDepartments($mainDepartment) as $key => $department)
                        <option value="{{ $key }}" {{ $parentDepartment == $key ? 'selected':'' }}>{{ $department }}</option>
                    @endforeach
                </select>
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('department_reference') ? ' has-error' : '' }}">
            {!! Form::label('department_reference', 'مرجعية الجهة', ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-8">
                {!! Form::text('department_reference', auth()->user()->department_reference, ['id' => 'department_reference', 'class' => 'form-control', 'disabled']) !!}
            </div>
        </div>
    </div>

</div>

<br />


<div class="row">

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('direct_department_id') ? ' has-error' : '' }}">

            {!! Form::label('direct_department_id', 'الإدارة', ['class' => 'col-md-4 control-label']) !!}

            <div class="col-md-8">
                <select name="direct_department_id" id="direct_department_id" class="form-control select2">
                    <option value="0">{{ __('users::departments.choose a department') }}</option>
                    @php
                        $directDepartment = isset($coordinator) ? $coordinator->direct_department_id:'';
                        if (old('direct_department_id')){
                            $directDepartment = old('direct_department_id');
                        }
                    @endphp
                    @foreach(\Modules\SystemManagement\Entities\Department::getDirectDepartments($parentDepartment) as $key => $department)
                        <option value="{{ $key }}" {{ $directDepartment == $key ? 'selected':'' }}>{{ $department }}</option>
                    @endforeach
                </select>

                @if ($errors->has('direct_department_id'))
                    <span class="help-block" ><strong>{{ $errors->first('direct_department_id') }}</strong></span>
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
                    <span class="help-block" ><strong>{{ $errors->first('job_title') }}</strong></span>
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
                    <span class="help-block" ><strong>{{ $errors->first('title') }}</strong></span>
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
                {!! Form::select('job_role_id', $coordinatorJob, null, ['id' => 'job_role_id', 'class' => 'form-control select2', 'disabled']) !!}
    
                @if ($errors->has('job_role_id'))
                    <span class="help-block" ><strong>{{ $errors->first('job_role_id') }}</strong></span>
                @endif
            </div>

        </div>
    </div>

</div>

<script>
    $(document).ready(function () {
        $('.select2').select2();

        $('.load-departments').change(function () {
            let path = $(this).attr('data-url') + '?parentId=' + $(this).val();
            let child = $(this).attr('data-child');
            // Empty Children
            $(child).empty();
            if ($(child).hasClass('load-departments')) {
                let childOfChild = $(child).attr('data-child');
                $(childOfChild).empty();
            }
            if ($(this).val() != 0){
                $.ajax({
                    url: path,
                    success: function (response) {
                        let select = $(child)[0];
                        let length = Object.keys(response).length;
                        for (let index = 0; index < length; index++) {
                            select.options[select.options.length] = new Option(response[index].name, response[index].id);
                        }
                    }
                });
            }
        });
    });
</script>