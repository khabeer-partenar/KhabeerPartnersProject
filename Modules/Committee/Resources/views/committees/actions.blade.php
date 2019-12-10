@if ($committee)
    @if(auth()->user()->hasPermissionWithAccess('show'))
        <a href="{{ route('committees.show', $committee) }}" class="btn btn-sm btn-default custom-action-btn">
            <i class="fa fa-eye"></i> {{ __('committee::committees.show') }}
        </a>
    @endif
    @if(auth()->user()->hasPermissionWithAccess('destroy'))
        <a data-href="{{ route('committees.destroy', $committee) }}" class="btn btn-sm btn-danger delete-row-reason custom-action-btn">
            <i class="fa fa-trash"></i> {{ __('committee::committees.delete') }}
        </a>
    @endif
@endif