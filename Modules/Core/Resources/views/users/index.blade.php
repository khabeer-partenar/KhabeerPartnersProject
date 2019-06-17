@extends('layouts.dashboard.index')

@section('page')
  <div class="panel panel-default">
      <div class="panel-heading">{{ __('core::users.title') }}</div>

      <table id="table-ajax" class="table panel-body"
             data-url="/core/users"
             data-fields='[
                {"data": "id","title":"ID","searchable":"true"},
                {"data": "name","title":"{{ __('messages.name') }}","searchable":"true"},
                {"data": "national_id","title":"{{ __('messages.national_id') }}","searchable":"true"},
                {"data": "email","title":"{{ __('messages.email') }}","searchable":"true"}

                @if(auth()->user()->hasPermissionWithAccess("upgrateToSuperAdmin"))
                    ,{"data": "action","name":"actions","searchable":"false", "orderable":"false"}
                @endif
                
             ]'>
           </table>
  </div>

@endsection
