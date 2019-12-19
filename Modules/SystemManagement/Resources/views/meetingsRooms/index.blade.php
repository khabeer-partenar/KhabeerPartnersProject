@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">
            <div class="row">

                <div class="col-md-9">
                    <div class="caption">
                        <i class="fa fa-map-marker"></i>
                        <span class="caption-subject sbold">{{ __('systemmanagement::meetingsRooms.title') }}</span>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="actions item-fl item-mb20">
                        @if(auth()->user()->hasPermissionWithAccess('create'))
                            <a href="{{ route('system-management.meetings-rooms.create') }}" class="btn btn-primary">{{ __('messages.add') }}</a>
                        @endif
                    </div>
                </div>

            </div>
        </div>

        <div class="portlet-body">
            <br>
            @include('systemmanagement::meetingsRooms.search')

            <table id="table-ajax" class="table" data-url="{{ route('system-management.meetings-rooms.index', [
                        'name' => Request::input('name'),
                        'city_id' => Request::input('city_id'),
                        'status' => Request::input('status')
                    ])
                }}"
                data-fields='[
                    {"data": "name","title":"{{ __('systemmanagement::meetingsRooms.name') }}","searchable":"false"},
                    {"data": "city_name","title":"{{ __('systemmanagement::meetingsRooms.city_name') }}","searchable":"false"},
                    {"data": "capacity","title":"{{ __('systemmanagement::meetingsRooms.capacity') }}","searchable":"false"},
                    {"data": "status_text","title":"{{ __('systemmanagement::meetingsRooms.status') }}","searchable":"false"},
                    {"data": "action","name":"actions","searchable":"false", "orderable":"false"}
                ]'
            >
            </table>


        </div>
       

    </div>
@endsection