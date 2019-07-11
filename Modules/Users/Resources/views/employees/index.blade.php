@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="caption">
                <i class="fa fa-users"></i>
                <span class="caption-subject sbold">{{ __('users::employees.title') }}</span>
            </div>
            
            <div class="actions">
                @if(auth()->user()->hasPermissionWithAccess('create'))
                    <a href="{{ route('employees.create') }}" class="btn btn-primary">{{ __('messages.add') }}</a>
                @endif
            </div>
        
        </div>

        <div class="portlet-body">

            @include('users::employees.search')

            <table id="table-ajax" class="table" data-url="{{ route('employees.index', [
                    'employee_id' => Request::input('employee_id'),
                    'job_role_id' => Request::input('job_role_id'),
                    'direct_department_id' => Request::input('direct_department_id')])
                }}"
                data-fields='[
                    {"data": "name","title":"{{ __('messages.name') }}","searchable":"false"},
                    {"data": "deptname","title":"{{ __('messages.deptname') }}","searchable":"false"},
                    {"data": "contact_options","title":"{{ __('users::employees.contact_options') }}","searchable":"false"},
                    {"data": "job_role","title":"{{ __('users::employees.job_role_id') }}","searchable":"false"},
                    {"data": "action","name":"actions","searchable":"false", "orderable":"false"}
                ]'
            >
            </table>

        </div>
       

    </div>
@endsection