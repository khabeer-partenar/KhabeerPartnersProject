@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="caption">
                <i class="fa fa-users"></i>
                <span class="caption-subject sbold">{{ __('users::employees.assignCommittees.title') }}</span>
            </div>
            
            <div class="actions" style="margin-bottom: 20px;">
            </div>
        
        </div>

        <div class="portlet-body">

            @include('users::employees.assign_committees.search')

            <table id="table-ajax" class="table" data-url="{{ route('employees.assign_committees.index', [
                    'employee_id' => Request::input('employee_id'),
                    'national_id' => Request::input('national_id'),
                    'employee_email' => Request::input('employee_email')])
                }}"
                data-fields='[
                    {"data": "name","title":"{{ __('messages.name') }}","searchable":"false"},
                    {"data": "deptname","title":"{{ __('users::employees.assignCommittees.deptname') }}","searchable":"false"},
                    {"data": "contact_options","title":"{{ __('users::employees.contact_options') }}","searchable":"false"},
                    {"data": "job_role","title":"{{ __('users::employees.job_role_id') }}","searchable":"false"},
                    {"data": "action","name":"actions","searchable":"false", "orderable":"false"}
                ]'
            >
            </table>

        </div>
       

    </div>
@endsection