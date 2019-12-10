@if($departmentData)
    
    @if(auth()->user()->hasPermissionWithAccess('edit'))
        <a href="{{ route('system-management.source-recommendation-study.edit', $departmentData) }}" class="btn btn-sm btn-warning custom-action-btn">
            <i class="fa fa-edit"></i> {{ __('systemmanagement::systemmanagement.edit_btn') }}
        </a>
    @endif

@endif