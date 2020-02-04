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

                <div class="col-md-3">
                    <div class="actions item-fl item-mb20">
                        <a href="{{ route('committee.meetings', compact('committee')) }}" class="btn red">{{ __('messages.goBack') }}</a>
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
                            <td>{{ $meeting->type->name }}</td>
                            <td>{{ $meeting->meeting_at. ' ' . $meeting->from  . ' ' . $meeting->to }}</td>
                            <td>{{ $meeting->reason }}</td>
                            <td>{{ $meeting->room->name }}</td>
                            <td>
                                <a>
                                    ترشيح مندوب جديد
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>

            </div>

            <hr>

            {{-- Participants --}}
            <div class="row">
                <div class="col-md-12">
                    <p>قائمة المرشحين من الجهة</p>
                    <table style="width: 100%" class="table table-bordered">
                        <thead>
                        <tr style="font-weight:bold">
                            <th scope="col">اسم المندوب</th>
                            <th scope="col">الجهة</th>
                            @if($meeting->attendance_done)
                                <th scope="col">حالة الحضور</th>
                            @endif
                            <th scope="col">حالة الدعوة</th>
                            <th scope="col">سبب الإعتذار</th>
                        </tr>
                        </thead>
                        <tbody id="">
                        @foreach($meeting->delegates as $delegate)
                            <tr>
                                <td>{{ $delegate->name }}</td>
                                <td>{{ $delegate->department->name }}</td>
                                @if ($meeting->attendance_done)
                                    <td>
                                        @if ($delegate->pivot->status == \Modules\Committee\Entities\MeetingDelegate::REJECTED)
                                            {{ __('committee::meetings.' . \Modules\Committee\Entities\MeetingDelegate::STATUS[$delegate->pivot->status]) }}
                                        @else
                                            {{ $delegate->pivot->attended ? __('committee::meetings.attended'):__('committee::meetings.absent') }}
                                        @endif
                                    </td>
                                @endif
                                <td>
                                    {{ __('committee::meetings.' . \Modules\Committee\Entities\MeetingDelegate::STATUS[$delegate->pivot->status]) }}
                                </td>
                                <td>{{ $delegate->pivot->status == \Modules\Committee\Entities\MeetingDelegate::REJECTED ? $delegate->pivot->refuse_reason:'' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection


@section('scripts_2')
    @include('committee::meetings.delegates.scripts')
@endsection