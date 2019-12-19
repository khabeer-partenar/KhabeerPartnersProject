@if($meetingRoom)
    
    @if(auth()->user()->hasPermissionWithAccess('edit'))
        <a href="{{ route('system-management.meetings-rooms.edit', $meetingRoom) }}" class="btn btn-sm btn-warning custom-action-btn">
            <i class="fa fa-edit"></i> {{ __('systemmanagement::systemmanagement.edit_btn') }}
        </a>
    @endif

    @if(auth()->user()->hasPermissionWithAccess('destroy'))
        <a data-href="{{ route('system-management.meetings-rooms.destroy', $meetingRoom) }}" class="btn btn-sm btn-warning delete-row custom-action-btn">
            <i class="fa fa-trash"></i> {{ __('systemmanagement::systemmanagement.delete_btn') }}
        </a>
    @endif

@endif