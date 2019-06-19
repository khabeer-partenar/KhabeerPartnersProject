@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="caption">
                <i class="fa fa-users"></i>
                <span class="caption-subject sbold">{{ __('users::users.title') }}</span>
            </div>
            
            <div class="actions">
                <a href="{{ route('users.create') }}" class="btn btn-primary">{{ __('users::users.action_add') }}</a>
            </div>
        
        </div>

        <div class="portlet-body">
            <table id="table-ajax" class="table" data-url="/users"
                data-fields='[
                    {"data": "id","title":"ID","searchable":"true"},
                    {"data": "name","title":"{{ __('messages.name') }}","searchable":"true"},
                    {"data": "email","title":"{{ __('messages.email') }}","searchable":"true"},
                    {"data": "national_id","title":"{{ __('messages.national_id') }}","searchable":"true"},
                    {"data": "phone_number","title":"{{ __('messages.phone_number') }}","searchable":"true"},
                    {"data": "action","name":"actions","searchable":"false", "orderable":"false"}
                ]'
            >
            </table>
        </div>
       

    </div>
@endsection
