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

                <div class="col-md-3">
                    <div class="actions item-fl item-mb20">
                        @if(auth()->user()->hasPermissionWithAccess('create'))
                            <a href="{{ route('committee.meetings.create', compact('committee')) }}"
                               class="btn btn-primary">{{ __('committee::meetings.action_add') }}</a>
                        @endif
                        <a href="{{ route('committees.index') }}" class="btn red">{{ __('messages.goBack') }}</a>
                    </div>
                </div>

            </div>

        </div>

        <div class="portlet-body">

            <br>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr role="row">
                            <th></th>
                            <th>نوع الإجتماع</th>
                            <th>موضوع الإجتماع</th>
                            <th>تاريخ و وقت الإجتماع</th>
                            <th>مكان الإجتماع</th>
                            <th>عدد المجتمعين</th>
                            <th>خيارات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($meetings as $meeting)
                            <tr>
                                <td>
                                    <div align="center">
                                        @if (!$meeting->completed)
                                            <i title="{{ __('committee::meetings.not_completed') }}"
                                               class="fa fa-2x fa-question-circle-o" style="color: #d6a329;" aria-hidden="true"></i>
                                        @elseif (auth()->user()->authorizedApps->key == \Modules\Users\Entities\Delegate::JOB &&
                                        !in_array(auth()->id(), $meeting->delegatesPivot->pluck('delegate_id')->toArray()))
                                            <i title="{{ __('committee::meetings.cannot_be_seen') }}"
                                               style="color: #e73d4a"
                                               class="fa fa-2x fa-ban" aria-hidden="true"></i>
                                        @elseif ($meeting->deleted_at)
                                            <i title="{{ __('committee::meetings.cancelled') }}"
                                               class="fa fa-2x fa-calendar-times-o" style="color: #e73d4a" aria-hidden="true"></i>
                                        @elseif($meeting->toDate > \Carbon\Carbon::now())
                                            <i title="{{ __('committee::meetings.incoming') }}"
                                               class="fa fa-2x fa-calendar" aria-hidden="true"></i>
                                        @elseif($meeting->toDate <= \Carbon\Carbon::now())
                                            <i title="{{ __('committee::meetings.finished') }}"
                                               class="fa fa-2x fa-calendar-check-o" style="color: #009247" aria-hidden="true"></i>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $meeting->type ? $meeting->type->name:'' }}</td>
                                <td>{{ $meeting->reason }}</td>
                                <td>
                                    {{ $meeting->meeting_at }} <br>
                                    {{ $meeting->from . ' - ' . $meeting->to }}
                                </td>
                                <td>{{ $meeting->room ? $meeting->room->name:'' }}</td>
                                <td>{{ count($meeting->attendingDelegates) + count($meeting->attendingAdvisors) }}</td>
                                <td>
                                    @if (auth()->user()->authorizedApps->key == \Modules\Users\Entities\Delegate::JOB )
                                        @if (in_array(auth()->id(), $meeting->delegatesPivot->pluck('delegate_id')->toArray()))
                                            <a href="{{ route('committees.meetings.delegate.show', compact('committee', 'meeting')) }}"
                                              class="btn btn-success">التفاصيل</a>
                                        @endif
                                    @else
                                        @if(auth()->user()->hasPermissionWithAccess('show', 'CommitteeMeetingController', 'Committee'))
                                            <a href="{{ route('committee.meetings.show', compact('committee', 'meeting')) }}"
                                               class="btn btn-success">التفاصيل</a>
                                        @endif

                                         @if(auth()->user()->hasPermissionWithAccess('create', 'MeetingAttendanceController', 'Committee')
                                         && $meeting->is_old && !$meeting->attendance_done)
                                            <a href="{{ route('committees.meetings.attendance.create', compact('committee', 'meeting')) }}"
                                               class="btn btn-success">تأكيد حضور المشاركين
                                            </a>
                                        @endif

                                        @if(auth()->user()->hasPermissionWithAccess('index', 'MeetingMultimediaController', 'Committee'))
                                            <a href="{{ route('committee.meetings.multimedia', compact('committee', 'meeting')) }}"
                                               class="btn btn-success">مرئيات المشاركين
                                            </a>
                                        @endif

                                        @if(
                                            auth()->user()->hasPermissionWithAccess('destroy', 'CommitteeMeetingController', 'Committee') &&
                                            !$meeting->is_old &&
                                            !$meeting->trashed()
                                        )
                                            <a data-href="{{ route('committee.meetings.cancel', compact('committee', 'meeting')) }}"
                                               class="btn btn-danger delete-row ">إلغاء</a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
