{{--@extends('layouts.dashboard.index')--}}

<!-- Modal -->
<div id="CalendarModal" class="modal fade" role="dialog" >
    <div class="modal-info" role="document" style="width: 40%; margin:0 auto;">

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
                        <div class="col-md-3">{{__('committee::meetings.meeting_title')}}<span>:</span></div>
                        <div class="col-md-6" id="title_data"></div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-3">{{__('committee::meetings.from')}} <span>:</span></div>
                        <div class="col-md-3" id="from_data"></div>

                        <div class="col-md-3">{{__('committee::meetings.to')}}<span>:</span></div>
                        <div class="col-md-3" id="to_data"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">{{__('committee::meetings.type')}}<span>:</span></div>
                        <div class="col-md-6" id="type_data"></div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-3">{{__('committee::meetings.chairman')}}<span>:</span></div>
                        <div class="col-md-6" id="chairman_data"></div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-3">{{__('committee::meetings.attendace_number')}}<span>:</span></div>
                        <div class="col-md-3" id="attendace_data"></div>
                        <div class="col-md-3">{{__('committee::meetings.absence_number')}}<span>:</span></div>
                        <div class="col-md-3" id="absence_data"></div>   
                    </div>

                    <div class="row">
                        <div class="col-md-3">{{__('committee::meetings.room')}}<span>:</span></div>
                        <div class="col-md-6" id="room_data"></div>
                    </div>
                </div>
            <div class="modal-footer">

                <button  type="button" class="btn btn-danger"
                        data-dismiss="modal">{{__('users::delegates.close_window')}}</button>

            </div>
        </div>

    </div>
</div>



