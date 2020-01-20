@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="row">

                <div class="col-md-9">
                    <div class="caption">
                        <i class="fa fa-users"></i>
                        <span class="caption-subject sbold">{{ __('committee::committees.meetings') }}</span>
                    </div>
                </div>
            </div>

        </div>

        <div class="portlet-body">
            <input id="meetings_data" value="{{ json_encode($meetings) }}" hidden>
            <br>
            <div id='calendar'></div>
        </div>

    </div>

    @include('committee::meetings.calendar_popup')

@endsection

@section('scripts_2')
    @include('committee::meetings.scripts')
@endsection
