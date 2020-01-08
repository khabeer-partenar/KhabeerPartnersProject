
<div class="row">

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('national_id') ? ' has-error' : '' }}">

            <label for="national_id" class="control-label">
                {{ __('users::employees.national_id') }}
            </label>

            {!! Form::text('national_id', auth()->user()->national_id, ['id' => 'national_id', 'class' => 'form_control accept_saudi_national_id_only', 'disabled' => true]) !!}

            @if ($errors->has('national_id'))
                <span class="help-block" ><strong>{{ $errors->first('national_id') }}</strong></span>
            @endif

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">

            <label for="name" class="control-label">
                {{ __('users::employees.name') }}
            </label>

            {!! Form::text('name', auth()->user()->name, ['id' => 'name', 'class' => 'form_control', 'disabled' => true]) !!}

            @if ($errors->has('name'))
                <span class="help-block" ><strong>{{ $errors->first('name') }}</strong></span>
            @endif
            
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('phone_number') ? ' has-error' : '' }}">

            <label for="phone_number" class="control-label">
                {{ __('users::employees.phone_number') }}
            </label>

            {!! Form::text('phone_number', auth()->user()->phone_number, ['id' => 'phone_number', 'class' => 'form_control accept_phone_numbers_only', 'disabled' => true]) !!}

            @if ($errors->has('phone_number'))
                <span class="help-block" ><strong>{{ $errors->first('phone_number') }}</strong></span>
            @endif

        </div>
    </div>

</div>



<br />


<div class="row">

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">

            <label for="email" class="control-label">
                {{ __('users::employees.email') }}
            </label>

            {!! Form::text('email', auth()->user()->email, ['id' => 'email', 'class' => 'form_control accept_gov_email_only', 'disabled' => true]) !!}

            @if ($errors->has('email'))
                <span class="help-block" ><strong>{{ $errors->first('email') }}</strong></span>
            @endif

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('job_role_id') ? ' has-error' : '' }}">

            <label for="job_role_id" class="control-label">
                {{ __('users::employees.job_role_id') }}
            </label>

            {!! Form::select('job_role_id', $rolesData, auth()->user()->job_role_id, ['id' => 'job_role_id', 'class' => 'form_control select2', 'disabled' => true]) !!}

            @if ($errors->has('job_role_id'))
                <span class="help-block" ><strong>{{ $errors->first('job_role_id') }}</strong></span>
            @endif

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('receive_sms') ? ' has-error' : '' }}">

            <label for="receive_sms" class="control-label">
                {{ __('users::account.receive_sms') }}
                <span style="color: red">*</span>
            </label>

            {!! Form::select('receive_sms', $receiveSmsOptions, null, ['id' => 'receive_sms', 'class' => 'form_control select2', 'required' => true]) !!}

            @if ($errors->has('receive_sms'))
                <span class="help-block" ><strong>{{ $errors->first('receive_sms') }}</strong></span>
            @endif

        </div>
    </div>



</div>
