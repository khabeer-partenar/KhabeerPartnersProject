<!-- Modal -->
<div id="CalendarModal" class="modal fade" role="dialog" >
    <div class="modal-info" role="document" style="width: 30%; margin: 10% auto;">

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
                <div class="table-responsive">
                    <table class="table table-borderless" style="width: 100%;">
                        <tbody>
                            <tr>
                                <th scope="row" style="width: 30%;">{{ __('committee::meetings.meeting_title') }}</th>
                                <td id="title_data" colspan="2"></td>
                            </tr>
                            <tr id="chairman_content">
                                <th scope="row" >{{__('committee::meetings.chairman')}}</th>
                                <td id="chairman_data" colspan="2"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{__('committee::meetings.type')}}</th>
                                <td id="type_data" colspan="2"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{__('committee::meetings.room')}}</th>
                                <td id="room_data" colspan="2"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{__('committee::meetings.from')}}</th>
                                <td id="from_data" colspan="2"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{__('committee::meetings.to')}}</th>
                                <td id="to_data" colspan="2"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('committee::meetings.accepted_number') }}</th>
                                <td id="attendace_data" colspan="2"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('committee::meetings.absence_number') }}</th>
                                <td id="absence_data" colspan="2"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <a id="meeting_details" href="" class="btn btn-info" role="button" >{{__('committee::meetings.details')}}</a>
                <button  type="button" class="btn btn-danger" data-dismiss="modal">{{__('users::delegates.close_window')}}</button>
            </div>
        </div>

    </div>
</div>



