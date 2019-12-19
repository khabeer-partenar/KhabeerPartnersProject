<div class="row">

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">

            <label for="name" class="control-label">
                {{ __('systemmanagement::meetingsRooms.name') }}
                <span style="color: red">*</span>
            </label>

            {!! Form::text('name', null, ['id' => 'name', 'class' => 'form_control', 'required' => true]) !!}

            @if ($errors->has('name'))
                <span class="help-block" ><strong>{{ $errors->first('name') }}</strong></span>
            @endif

        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('city_id') ? ' has-error' : '' }}">

            <label for="city_id" class="control-label">
                {{ __('systemmanagement::meetingsRooms.city_name') }}
                <span style="color: red">*</span>
            </label>

            {!! Form::select('city_id', $cities, null, ['id' => 'city_id', 'class' => 'form_control select2', 'required' => true]) !!}

            @if ($errors->has('city_id'))
                <span class="help-block" ><strong>{{ $errors->first('city_id') }}</strong></span>
            @endif

        </div>
    </div>

</div>

<div class="row">

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('capacity') ? ' has-error' : '' }}">

            <label for="capacity" class="control-label">
                {{ __('systemmanagement::meetingsRooms.capacity') }}
                <span style="color: red">*</span>
            </label>

            {!! Form::number('capacity', null, ['id' => 'capacity', 'class' => 'form_control', 'required' => true]) !!}

            @if ($errors->has('capacity'))
                <span class="help-block" ><strong>{{ $errors->first('capacity') }}</strong></span>
            @endif

        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">

            <label for="status" class="control-label">
                {{ __('systemmanagement::meetingsRooms.status') }}
                <span style="color: red">*</span>
            </label>

            {!! Form::select('status', $statues, null, ['id' => 'status', 'class' => 'form_control select2', 'required' => true]) !!}

            @if ($errors->has('status'))
                <span class="help-block" ><strong>{{ $errors->first('status') }}</strong></span>
            @endif

        </div>
    </div>

</div>
