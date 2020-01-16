{{--@extends('layouts.dashboard.index')--}}

<!-- Modal -->
<div id="CalendarModal" class="modal fade" role="dialog" >
    <div class="modal-info" role="document" style="width: 30%; margin:300px auto 0 auto">

        <!-- Modal content-->
        <div class="modal-content">
            <div style="height: 50px; background-color: #057d54"
                 class="modal-header d-flex text-center justify-content-center">
                <p style="color: white" class="heading">
                    <strong>{{ __('committee::meetings.calendar_meeting_details') }}</strong>

                </p>
                <div class="clearfix"></div>

            </div>

            <div class="modal-body" style="width:100%;height:90%;">
                    <div class="row">
                        <div class="col-md-9" >{{__('committee::meetings.meeting_title')}}   :   <span id="title_data"></span></div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6" >{{__('committee::meetings.chairman')}}   :   <span id="chairman_data"></span></div>
                        <div class="col-md-6" >{{__('committee::meetings.type')}}   :   <span id="type_data"></span></div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6" >{{__('committee::meetings.room')}}  :   <span id="room_data"></span></div>
                        <div class="col-md-3" >{{__('committee::meetings.from')}}  :   <span id="from_data"></span></div>
                        <div class="col-md-3" >{{__('committee::meetings.to')}}   :   <span id="to_data"></span></div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6" > {{__('committee::meetings.attendace_number')}}   :   <span id="attendace_data"></span></div>
                        <div class="col-md-6" >{{__('committee::meetings.absence_number')}}   :   <span id="absence_data"></span></div>   
                    </div>
                </div>
            <div class="modal-footer">

                <button  type="button" class="btn btn-danger"
                        data-dismiss="modal">{{__('users::delegates.close_window')}}</button>

            </div>
        </div>

    </div>
</div>



