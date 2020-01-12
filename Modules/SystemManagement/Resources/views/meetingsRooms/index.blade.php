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


            <table class="table">
                <thead>

                    <tr role="row">
                        <th>{{ __('systemmanagement::meetingsRooms.name') }}</th>
                        <th>{{ __('systemmanagement::meetingsRooms.city_name') }}</th>
                        <th>{{ __('systemmanagement::meetingsRooms.capacity') }}</th>
                        <th>{{ __('systemmanagement::meetingsRooms.status') }}</th>
                        <th></th>
                    </tr>

                </thead>
                <tbody>
                    
                    @foreach($meetingsRoomsData as $key => $meetingRoom)
                        <tr>
                            <td>{{ $meetingRoom->name }}</td>
                            <td>{{ @$meetingRoom->city->name }}</td>
                            <td>{{ $meetingRoom->capacity }}</td>
                            <td>{{ $meetingRoom->status_text }}</td>
                            <td>
                                @if(auth()->user()->hasPermissionWithAccess('edit'))
                                    <a href="{{ route('system-management.meetings-rooms.edit', $meetingRoom) }}" class="btn btn-sm btn-warning custom-action-btn">
                                        <i class="fa fa-edit"></i> {{ __('systemmanagement::systemmanagement.edit_btn') }}
                                    </a>
                                @endif

                                @if(auth()->user()->hasPermissionWithAccess('destroy'))
                                    <a data-href="{{ route('system-management.meetings-rooms.destroy', $meetingRoom) }}" class="btn btn-sm btn-warning delete-row custom-action-btn">
                                        <i class="fa fa-trash"></i> {{ __('systemmanagement::systemmanagement.delete_btn') }}
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    @if($meetingsRoomsData->count() == 0)
                        <tr>
                            <td colspan="5"><center>لا يوجد بيانات</center></td>
                        </tr>
                    @endif

                
                </tbody>
            </table>

            {{ $meetingsRoomsData->links() }}

        </div>
       

    </div>
@endsection