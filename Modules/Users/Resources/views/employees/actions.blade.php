@if($employee)

    @if(auth()->user()->hasPermissionWithAccess('upgrateToSuperAdmin'))
        <a href="{{ route('employees.upgrate_to_super_admin', $employee) }}" class="btn btn-sm btn-primary custom-action-btn">
            <i class="fa fa-key"></i> Admin
        </a>
    @endif

    @if(auth()->user()->hasPermissionWithAccess('show'))
        <a href="{{ route('employees.show', $employee) }}" class="btn btn-sm btn-default custom-action-btn">
            <i class="fa fa-eye"></i> {{ __('users::employees.information_btn') }}
        </a>
    @endif

    @if(auth()->user()->hasPermissionWithAccess('destroy'))
        <a data-href="{{ route('employees.destroy', $employee) }}" class="btn btn-sm btn-danger delete-row custom-action-btn">
            <i class="fa fa-trash"></i> {{ __('users::employees.delete_btn') }}
        </a>
    @endif

@endif