@if($departmentData)

    @if(auth()->user()->hasPermissionWithAccess('updateOrder'))
        <a class="btn btn-sm btn-default change_dept_order custom-action-btn" data-backend-url={{ route('system-management.departments.updateOrder', $departmentData) }} data-action="up">
            <i class="fa fa-arrow-up" aria-hidden="true"></i>
        </a>

        <a class="btn btn-sm btn-default change_dept_order custom-action-btn" data-backend-url={{ route('system-management.departments.updateOrder', $departmentData) }} data-action="down">
            <i class="fa fa-arrow-down" aria-hidden="true"></i>
        </a>
    @endif
    
    @if(auth()->user()->hasPermissionWithAccess('departmentsTypesEdit'))
        <a href="{{ route('system-management.departments-types.edit', $departmentData) }}" class="btn btn-sm btn-warning custom-action-btn">
            <i class="fa fa-edit"></i> {{ __('systemmanagement::systemmanagement.edit_btn') }}
        </a>
    @endif
    
    @if(auth()->user()->hasPermissionWithAccess('destroy'))    
        <a data-href="{{ route('system-management.departments.destroy', $departmentData) }}" class="btn btn-sm btn-danger delete-row custom-action-btn">
            <i class="fa fa-trash"></i> {{ __('systemmanagement::systemmanagement.delete_btn') }}
        </a>
    @endif

@endif