@if($employee)

    <a href="{{ route('users.upgrate_to_super_admin', $employee) }}" class="btn btn-xs btn-{{ ($employee->is_super_admin == 1 ? 'danger' : 'primary') }}">
        <i class="fa fa-key"></i> Admin
    </a>

    <a href="{{ route('employees.show', $employee) }}" class="btn btn-xs btn-primary">
        <i class="fa fa-eye"></i> {{ __('users::employees.information_btn') }}
    </a>

    <a href="{{ route('employees.destroy-confirmation', $employee->id) }}" class="btn btn-xs btn-danger">
        <i class="fa fa-trash"></i> {{ __('users::employees.delete_btn') }}
    </a>

@endif