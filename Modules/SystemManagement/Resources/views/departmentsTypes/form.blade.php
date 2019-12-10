<div class="row">

    <div class="col-md-12">
        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">

            <label for="name" class="control-label">
                {{ __('systemmanagement::systemmanagement.deptName') }}
                <span style="color: red">*</span>
            </label>

            {!! Form::text('name', null, ['id' => 'name', 'class' => 'form_control', 'required' => true]) !!}

            @if ($errors->has('name'))
                <span class="help-block" ><strong>{{ $errors->first('name') }}</strong></span>
            @endif

        </div>
    </div>

</div>
