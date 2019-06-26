@if($employee)

    <a href="{{ route('users.upgrate_to_super_admin', $employee->id) }}" class="btn btn-xs btn-{{ ($employee->is_super_admin == 1 ? 'danger' : 'primary') }} confirm-message">
        <i class="fa fa-key"></i> Admin
    </a>

    <a href="{{ route('users.show', $employee->id) }}" class="btn btn-xs btn-primary">
        <i class="fa fa-eye"></i> {{ __('users::users.information_btn') }}
    </a>

    <a href="{{ route('users.destroy-confirmation', $employee->id) }}" class="btn btn-xs btn-danger">
        <i class="fa fa-trash"></i> {{ __('users::users.delete_btn') }}
    </a>

@endif