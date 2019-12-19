{{ Form::open(['route' => 'system-management.meetings-rooms.index', 'method' => 'GET']) }}

    <div class="row">

        <div class="col-md-4">
            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">

                {!! Form::label('name', __('systemmanagement::meetingsRooms.name'), ['class' => 'control-label']) !!}

                {!! Form::text('name', null, ['id' => 'name', 'class' => 'form_control']) !!}

                @if ($errors->has('name'))
                    <span class="help-block" ><strong>{{ $errors->first('name') }}</strong></span>
                @endif

            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group {{ $errors->has('city_id') ? ' has-error' : '' }}">

                {!! Form::label('city_id', __('systemmanagement::meetingsRooms.city_name'), ['class' => 'control-label']) !!}

                {!! Form::select('city_id', $cities, '', ['id' => 'city_id', 'class' => 'form_control select2']) !!}

                @if ($errors->has('city_id'))
                    <span class="help-block" ><strong>{{ $errors->first('city_id') }}</strong></span>
                @endif

            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">

                {!! Form::label('status', __('systemmanagement::meetingsRooms.status'), ['class' => 'control-label']) !!}

                {!! Form::select('status', $statues, '', ['id' => 'status', 'class' => 'form_control select2']) !!}

                @if ($errors->has('status'))
                    <span class="help-block" ><strong>{{ $errors->first('status') }}</strong></span>
                @endif

            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                    {{ Form::button(__('messages.search_btn'), ['type' => 'submit', 'class' => 'btn btn-primary_s']) }}
            </div>
        </div>

    </div>

{{ Form::close() }}