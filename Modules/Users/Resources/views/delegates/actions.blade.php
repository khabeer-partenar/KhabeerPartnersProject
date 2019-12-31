@if ($delegate)
    @if(auth()->user()->hasPermissionWithAccess('show'))
        <a href="{{ route('delegates.show', $delegate) }}" class="btn btn-sm btn-default custom-action-btn">
            <i class="fa fa-eye"></i> {{ __('users::delegates.show') }}
        </a>
    @endif
    @if(auth()->user()->hasPermissionWithAccess('destroy'))
        <a data-href="{{ route('delegates.destroy', $delegate) }}" class="btn btn-sm btn-danger delete-row custom-action-btn">
            <i class="fa fa-trash"></i> {{ __('users::delegates.delete') }}
        </a>
    @endif
@endif