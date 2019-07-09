@if($departmentData)

    <a href="#" class="change_dept_order" data-backend-url={{ route('system-management.departments.updateOrder', $departmentData) }} data-action="up">
        <i class="fa fa-arrow-up" aria-hidden="true"></i>
    </a>

    <a href="#" class="change_dept_order" data-backend-url={{ route('system-management.departments.updateOrder', $departmentData) }} data-action="down">
        <i class="fa fa-arrow-down" aria-hidden="true"></i>
    </a>

    <a href="{{ route('system-management.departments-types.edit', $departmentData) }}" class="btn btn-sm btn-warning">
        <i class="fa fa-edit"></i> {{ __('systemmanagement::systemmanagement.edit_btn') }}
    </a>
    
    <a data-href="{{ route('system-management.departments.destroy', $departmentData) }}" class="btn btn-sm btn-danger delete-row">
        <i class="fa fa-trash"></i> {{ __('systemmanagement::systemmanagement.delete_btn') }}
    </a>

@endif