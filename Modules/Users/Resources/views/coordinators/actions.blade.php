@if ($coordinator)
    <a href="{{ route('coordinators.show', $coordinator) }}" class="btn btn-sm btn-primary">
        <i class="fa fa-eye"></i> {{ __('users::coordinators.show') }}
    </a>

    <a href="{{ route('coordinators.edit', $coordinator) }}" class="btn btn-sm btn-warning">
        <i class="fa fa-edit"></i> {{ __('users::coordinators.edit') }}
    </a>

    <a data-href="{{ route('coordinators.destroy', $coordinator) }}" class="btn btn-sm btn-danger delete-row">
        <i class="fa fa-trash"></i> {{ __('users::coordinators.delete') }}
    </a>
@endif