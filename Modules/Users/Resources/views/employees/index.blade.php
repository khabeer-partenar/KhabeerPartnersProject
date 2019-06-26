@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="caption">
                <i class="fa fa-users"></i>
                <span class="caption-subject sbold">{{ __('users::employees.title') }}</span>
            </div>
            
            <div class="actions">
                <a href="{{ route('employees.create') }}" class="btn btn-primary">{{ __('users::employees.add_action') }}</a>
            </div>
        
        </div>

        <div class="portlet-body">

            @include('users::employees.search')

            <table id="table-ajax" class="table" data-url="{{ $userDatatableURL }}"
                data-fields='[
                    {"data": "name","title":"{{ __('messages.name') }}","searchable":"false"},
                    {"data": "deptname","title":"{{ __('messages.deptname') }}","searchable":"false"},
                    {"data": "email","title":"{{ __('messages.email') }}","searchable":"false"},
                    {"data": "phone_number","title":"{{ __('messages.phone_number') }}","searchable":"false"},
                    {"data": "job_role","title":"{{ __('users::employees.job_role_id') }}","searchable":"false"},
                    {"data": "action","name":"actions","searchable":"false", "orderable":"false"}
                ]'
            >
            </table>

        </div>
       

    </div>
@endsection