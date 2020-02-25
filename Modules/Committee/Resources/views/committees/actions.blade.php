@if ($committee)
    @if(auth()->user()->hasPermissionWithAccess('show'))
        <a href="{{ route('committees.show', $committee->id) }}" class="btn btn-sm btn-primary custom-action-btn">
            <i class="fa fa-eye"></i> {{ __('committee::committees.show') }}
        </a>
    @endif
    @if(auth()->user()->hasPermissionWithAccess('index','CommitteeMeetingController','Committee'))
        <a href="{{ route('committee.meetings', $committee->id) }}" class="btn btn-sm btn-primary custom-action-btn">
            <i class="fa fa-calendar"></i> {{ __('committee::committees.meetings') }}
        </a>
    @endif
    @if(auth()->user()->hasPermissionWithAccess('index', 'CommitteeMultimediaController', 'Committee'))
        <a href="{{ route('committee.multimedia', $committee->id) }}" class="btn btn-sm btn-primary custom-action-btn">
            <i class="fa fa-comments"></i> مرئيات المشاركين
        </a>
    @endif
    @if (auth()->user()->user_type == \Modules\Users\Entities\Coordinator::TYPE)
        @if(auth()->user()->hasPermissionWithAccess('show', 'CommitteeAttendanceController', 'Committee'))
            <a href="{{ route('committees.attendance', $committee->id) }}" class="btn btn-success">
                <i class="fa fa-users"></i> حالة الحضور
            </a>
        @endif
    @endif
    @if (auth()->user()->user_type == \Modules\Users\Entities\Delegate::TYPE)
        @if(auth()->user()->hasPermissionWithAccess('store', 'CommitteeMultimediaController', 'Committee'))
            <a href="{{ route('committee.multimedia.create', $committee->id) }}" class="btn btn-success">
                <i class="fa fa-users"></i>المرئيات
            </a>
        @endif
    @endif
    @if(auth()->user()->hasPermissionWithAccess('destroy') && in_array(auth()->id(), [$committee->created_by, $committee->advisor_id]))
        <a data-href="{{ route('committees.destroy', $committee->id) }}" class="btn btn-sm btn-danger delete-row-reason custom-action-btn">
            <i class="fa fa-trash"></i> {{ __('committee::committees.delete') }}
        </a>
    @endif
@endif