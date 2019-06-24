@if ($coordinator)
    <a href="{{ route('coordinators.edit', $coordinator) }}" class="btn btn-xs btn-primary">
        <i class="fa fa-edit"></i> {{ __('users::coordinators.edit') }}
    </a>

    <a data-href="{{ route('coordinators.destroy', $coordinator) }}" class="btn btn-xs btn-danger delete-row">
        <i class="fa fa-trash"></i> {{ __('users::coordinators.delete') }}
    </a>
@endif