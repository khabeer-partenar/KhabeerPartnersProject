@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="caption">
                <i class="fa fa-bars"></i>
                <span class="caption-subject sbold">{{ __('systemmanagement::systemmanagement.departmentsTypes') }}</span>
            </div>
            
            <div class="actions">
                {{-- @if(auth()->user()->hasPermissionWithAccess('create')) --}}
                    <a href="{{ route('system-management.departments-types.create') }}" class="btn btn-primary">{{ __('messages.add') }}</a>
                {{-- @endif --}}
            </div>
        
        </div>

        <div class="portlet-body">
            
            @include('systemmanagement::departmentsTypes.search')

            <table id="table-ajax" class="table" data-url="{{ route('system-management.departments-types.index', [
                        'department_id' => Request::input('department_id')
                    ])
                }}"
                data-fields='[
                    {"data": "name","title":"{{ __('systemmanagement::systemmanagement.departmentTypeName') }}","searchable":"false"},
                    {"data": "action","name":"actions","searchable":"false", "orderable":"false"}
                ]'
            >
            </table>
        </div>
       

    </div>
@endsection

@section('scripts_2')
    @include('systemmanagement::shared.scripts')
@endsection