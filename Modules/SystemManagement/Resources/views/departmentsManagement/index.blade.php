@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="caption">
                <i class="fa fa-bars"></i>
                <span class="caption-subject sbold">{{ __('systemmanagement::systemmanagement.departmentsManagement') }}</span>
            </div>
            
            <div class="actions">
                {{-- @if(auth()->user()->hasPermissionWithAccess('create')) --}}
                    <a href="{{ route('system-management.departments-management.create') }}" class="btn btn-primary">{{ __('messages.add') }}</a>
                {{-- @endif --}}
            </div>
        
        </div>

        <div class="portlet-body">
            
            @include('systemmanagement::departmentsManagement.search')

            <table id="table-ajax" class="table" data-url="{{ route('system-management.departments-management.index', [
                        'parent_department_id' => Request::input('parent_department_id'),
                        'main_department_id' => Request::input('main_department_id'),
                    ])
                }}"
                data-fields='[
                    {"data": "parent_name","title":"{{ __('systemmanagement::systemmanagement.departmentManagementParentName') }}","searchable":"false"},
                    {"data": "name","title":"{{ __('systemmanagement::systemmanagement.departmentManagementName') }}","searchable":"false"},
                    {"data": "reference_name","title":"{{ __('systemmanagement::systemmanagement.departmentManagementReferenceName') }}","searchable":"false"},
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