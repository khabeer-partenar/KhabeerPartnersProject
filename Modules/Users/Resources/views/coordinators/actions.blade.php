@if ($coordinator)
    @if(auth()->user()->hasPermissionWithAccess('show'))
        <a href="{{ route('coordinators.show', $coordinator) }}" class="btn btn-sm btn-default">
            <i class="fa fa-eye"></i> {{ __('users::coordinators.show') }}
        </a>
    @endif
    @if(auth()->user()->hasPermissionWithAccess('destroy'))
        <a data-href="{{ route('coordinators.destroy', $coordinator) }}" class="btn btn-sm btn-danger delete-row">
            <i class="fa fa-trash"></i> {{ __('users::coordinators.delete') }}
        </a>
    @endif
@endif