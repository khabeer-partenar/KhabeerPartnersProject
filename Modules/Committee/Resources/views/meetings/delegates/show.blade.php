@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="row">

                <div class="col-md-9">
                    <div class="caption">
                        <span class="caption-subject sbold">{{ __('committee::delegate_meeting.meeting_detail') }}</span>
                    </div>
                </div>


            </div>

        </div>

        <div class="portlet-body form">
            <div class="row">
                <div class="col-md-12">
                    <table style="width: 100%" class="table table-bordered mt-10">
                        <thead>
                        <tr>
                            <th scope="col">{{ __('committee::delegate_meeting.meeting_type') }}</th>
                            <th scope="col">{{ __('committee::delegate_meeting.meeting_date') }}</th>
                            <th scope="col">{{ __('committee::delegate_meeting.meeting_subject') }}</th>
                            <th scope="col">{{ __('committee::delegate_meeting.meeting_location') }}</th>
                            <th scope="col">{{ __('committee::delegate_meeting.meeting_action') }}</th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$meeting->type_id}}</td>
                            <td>{{$meeting->MeetingAt. ' ' . $meeting->From  . ' ' . $meeting->To}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>


        </div>

        <div class="actions item-fl item-mb20">
            <a href="{{ route('committees.index') }}" class="btn red">{{ __('messages.goBack') }}</a>
        </div>
    </div>
@endsection


@section('scripts_2')
    {{--@include('committee::meetings.scripts')--}}
@endsection