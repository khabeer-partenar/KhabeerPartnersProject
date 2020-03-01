@if(auth()->user()->hasPermissionWithAccess('index', 'PermissionsController'))
    <a href="{{ route('core.group_permissions', ['id' => $id])  }}" class="btn btn-xs btn-primary">
        <i class="fa fa-key"></i> {{ __('core::groups.permissions') }}
    </a>
@endif

@if(auth()->user()->hasPermissionWithAccess('edit'))
    <a href="{{ route('core.groups.edit', ['id' => $id])  }}" class="btn btn-xs btn-info">
        <i class="fa fa-pencil"></i> {{ __('core::groups.action_edit') }}
    </a>
@endif

@if(auth()->user()->hasPermissionWithAccess('show'))
    <a href="{{ route('core.groups.show', ['id' => $id]) }}" class="btn btn-xs btn-primary">
        <i class="fa fa-eye"></i>{{ __('core::groups.action_show') }}
    </a>
@endif
      

@if(auth()->user()->hasPermissionWithAccess('destroy'))
        <button type="button" class="btn btn-xs btn-danger delete-row" data-href="{{route('core.groups.destroy',$id)}}">
            <i class="fa fa-trash-o"></i>
            {{ __('core::groups.action_delete') }}
        </button>
@endif