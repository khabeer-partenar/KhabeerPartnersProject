@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="row">

                <div class="col-md-8">
                    <div class="caption">
                        <i class="fa fa-users"></i>
                        <span class="caption-subject sbold">{{ __('committee::committees.meetings') }}</span>
                    </div>
                </div>
                @if( auth()->user()->is_super_admin || auth()->user()->authorizedApps->key == \Modules\Users\Entities\Employee::SECRETARY)
                <div class="col-md-4" >
                    <div class="form-group">
                        <select name="advisor_id" id="advisor_id" class="form_control select2">
                            <option value="0">{{ __('committee::committees.all') }}</option>
                            @foreach($advisors as $key => $name)
                                <option value="{{ $key }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif
            </div>

        </div>

        <div class="portlet-body">
            <br>
            <div id='calendar'></div>
        </div>

    </div>

    @include('committee::meetings.calendar.popup')

@endsection

@section('scripts_2')
    @include('committee::meetings.calendar.scripts')
@endsection
