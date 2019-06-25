@if($user)

    <a href="{{ route('users.upgrate_to_super_admin', $user->id) }}" class="btn btn-xs btn-{{ ($user->is_super_admin == 1 ? 'danger' : 'primary') }} confirm-message">
        <i class="fa fa-key"></i> Admin
    </a>

    <a href="{{ route('users.show', $user) }}" class="btn btn-xs btn-primary">
        <i class="fa fa-eye"></i> {{ __('users::users.information_btn') }}
    </a>

    <a href="{{ route('users.destroy-confirmation', $user->id) }}" class="btn btn-xs btn-danger">
        <i class="fa fa-trash"></i> {{ __('users::users.delete_btn') }}
    </a>

@endif