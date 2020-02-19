@if ($committee)
    @if(auth()->user()->hasPermissionWithAccess('show'))
        <a href="{{ route('committees.show', $committee) }}" class="btn btn-sm btn-primary custom-action-btn">
            <i class="fa fa-eye"></i> {{ __('committee::committees.show') }}
        </a>
    @endif
    @if(auth()->user()->hasPermissionWithAccess('index','CommitteeMeetingController','Committee'))
        <a href="{{ route('committee.meetings', $committee) }}" class="btn btn-sm btn-primary custom-action-btn">
            <i class="fa fa-calendar"></i> {{ __('committee::committees.meetings') }}
        </a>
    @endif
    @if(auth()->user()->hasPermissionWithAccess('index', 'CommitteeMultimediaController', 'Committee'))
        <a href="{{ route('committee.multimedia', $committee) }}" class="btn btn-sm btn-primary custom-action-btn">
            <i class="fa fa-comments"></i> مرئيات المشاركين
        </a>
    @endif
    @if (auth()->user()->user_type == \Modules\Users\Entities\Coordinator::TYPE)
        @if(auth()->user()->hasPermissionWithAccess('show', 'CommitteeAttendanceController', 'Committee'))
            <a href="{{ route('committees.attendance', compact('committee')) }}" class="btn btn-success">
                <i class="fa fa-users"></i> حالة الحضور
            </a>
        @endif
    @endif
@endif