@if($departmentData)

    <a href="{{ route('system-management.departments-management.edit', $departmentData) }}" class="btn btn-sm btn-warning">
        <i class="fa fa-edit"></i> {{ __('systemmanagement::systemmanagement.edit_btn') }}
    </a>
    
    <a data-href="{{ route('system-management.departments.destroy', $departmentData) }}" class="btn btn-sm btn-danger delete-row">
        <i class="fa fa-trash"></i> {{ __('systemmanagement::systemmanagement.delete_btn') }}
    </a>

@endif