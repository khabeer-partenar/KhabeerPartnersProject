@if (auth()->user()->authorizedApps->key == \Modules\Users\Entities\Delegate::JOB )
    @if (in_array(auth()->id(), $meeting->delegatesPivot->pluck('delegate_id')->toArray()))
        @if (($meeting->delegates[0]->pivot->status == !\Modules\Committee\Entities\MeetingDelegate::REJECTED) ||  ($meeting->delegates[0]->pivot->status == \Modules\Committee\Entities\MeetingDelegate::ACCEPTED) || ($meeting->delegates[0]->pivot->status == \Modules\Committee\Entities\MeetingDelegate::INVITED))
            <a href="{{ route('committees.meetings.delegate.show', compact('committee', 'meeting')) }}"
                class="btn btn-success">التفاصيل</a>
                <a href="{{ route('committee.meetings.multimedia', compact('committee', 'meeting')) }}"
                class="btn btn-success">مرئيات المشاركين
                </a>
        @endif
    @endif
@elseif (auth()->user()->user_type == \Modules\Users\Entities\Coordinator::TYPE)
    @if (auth()->user()->hasPermissionWithAccess('show', 'CoordinatorMeetingController', 'Committee'))
        <a href="{{ route('committees.meetings.co.show', compact('committee', 'meeting')) }}"
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
