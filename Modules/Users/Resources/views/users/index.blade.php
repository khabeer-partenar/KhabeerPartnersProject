@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="caption">
                <i class="fa fa-users"></i>
                <span class="caption-subject sbold">{{ __('users::users.title') }}</span>
            </div>
            
            <div class="actions">
                <a href="{{ route('users.create') }}" class="btn btn-primary">{{ __('users::users.add_action') }}</a>
            </div>
        
        </div>

        <div class="portlet-body">
            <table id="table-ajax" class="table" data-url="/users"
                data-fields='[
                    {"data": "id","title":"ID","searchable":"false"},
                    {"data": "name","title":"{{ __('messages.name') }}","searchable":"false"},
                    {"data": "deptname","title":"{{ __('messages.deptname') }}","searchable":"false"},
                    {"data": "email","title":"{{ __('messages.email') }}","searchable":"false"},
                    {"data": "phone_number","title":"{{ __('messages.phone_number') }}","searchable":"false"},
                    {"data": "job_role","title":"{{ __('users::users.job_role_id') }}","searchable":"false"},
                    {"data": "action","name":"actions","searchable":"false", "orderable":"false"}
                ]'
            >
            </table>
        </div>
       

    </div>
@endsection
