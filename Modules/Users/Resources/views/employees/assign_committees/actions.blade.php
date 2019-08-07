@if($employee)

    @if(auth()->user()->hasPermissionWithAccess('edit'))
        <a href="{{ route('employees.assign_committees.edit', $employee) }}" class="btn btn-sm btn-warning">
            <i class="fa fa-edit"></i> {{ __('messages.edit') }}
        </a>
    @endif


@endif