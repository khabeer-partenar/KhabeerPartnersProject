<div class="row">

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('main_department_id') ? ' has-error' : '' }}">

            <label for="main_department_id" class="col-md-4 control-label">
                {{ __('systemmanagement::systemmanagement.departmentManagementParentName') }}
                <span style="color: red">*</span>
            </label>

            <div class="col-md-8">
                {!! Form::select('main_department_id', $mainDepartmentsData, @$department->parent_id, ['id' => 'main_department_id', 'class' => 'form_control select2', (@$department ? 'disabled' : '')]) !!}

                @if ($errors->has('main_department_id'))
                    <span class="help-block" ><strong>{{ $errors->first('main_department_id') }}</strong></span>
                @endif
            </div>

        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">

            <label for="name" class="col-md-4 control-label">
                {{ __('systemmanagement::systemmanagement.departmentManagementName') }}
                <span style="color: red">*</span>
            </label>

            <div class="col-md-8">
                {!! Form::text('name', null, ['id' => 'name', 'class' => 'form_control']) !!}

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
                {!! Form::text('telephone', null, ['id' => 'telephone', 'class' => 'form_control']) !!}

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
                {!! Form::text('address', null, ['id' => 'address', 'class' => 'form_control']) !!}

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
                {!! Form::text('email', null, ['id' => 'email', 'class' => 'form_control']) !!}

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
                {!! Form::checkbox('is_reference', 1, null, ['id' => 'is_reference', (@$department ? 'disabled' : '')]) !!}

                @if ($errors->has('is_reference'))
                    <span class="help-block" ><strong>{{ $errors->first('is_reference') }}</strong></span>
                @endif
            </div>

        </div>
    </div>

</div>

<br />

<div class="row">

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('reference_id') ? ' has-error' : '' }}">

            <label for="reference_id" class="col-md-4 control-label">
                {{ __('systemmanagement::systemmanagement.departmentManagementReferenceName') }}
                <span style="color: red">*</span>
            </label>

            <div class="col-md-8">
                {!! Form::select('reference_id', $parentDepartmentsData, null, ['id' => 'reference_id', 'class' => 'form_control select2', (old('is_reference') == 1 || @$department ? 'disabled' : '') ]) !!}

                @if ($errors->has('reference_id'))
                    <span class="help-block" ><strong>{{ $errors->first('reference_id') }}</strong></span>
                @endif
            </div>

        </div>
    </div>

</div>



@section('scripts_2')

    <script>
        $(document).ready(function() {
            $('#is_reference').on('click',function () {
                if ($('#is_reference').is(':checked')) {
                    $('#reference_id').prop('disabled', 'disabled');
                } else {
                    $('#reference_id').prop('disabled', false);
                }
            });
        });
    </script>

@endsection
