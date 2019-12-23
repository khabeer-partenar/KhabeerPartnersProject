<div class="row">

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('resource_staff_number') ? ' has-error' : '' }}">
            <label for="resource_staff_number" class="control-label">
                {{ __('committee::committees.resource_staff_number') }}
                <span style="color: red">*</span>
            </label>
            {!! Form::text('resource_staff_number', null, ['id' => 'resource_staff_number', 'class' => 'form_control']) !!}
            @include('layouts.dashboard.form-error', ['key' => 'resource_staff_number'])
        </div>

    </div>

</div>