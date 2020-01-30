@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="row">

                <div class="col-md-9">
                    <div class="caption">
                        <span class="caption-subject sbold">{{ __('committee::delegate_meeting.meeting_detail') }}</span>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="actions item-fl item-mb20">
                        <a href="{{ route('committee.meetings', compact('committee')) }}" class="btn red">{{ __('messages.goBack') }}</a>
                    </div>
                </div>

            </div>

        </div>

        <div class="portlet-body form">


            {{ Form::model($meeting, ['route' => ['committees.meetings.delegate.update', $committee, $meeting], 'method' => 'PUT', 'id' => 'delegate-meeting-form']) }}

            @if($errors->any())
                <div class="alert alert-danger">{{ __('messages.error_message') }}</div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <table style="width: 100%" class="table table-bordered mt-10">
                        <thead>
                        <tr>
                            <th scope="col">{{ __('committee::delegate_meeting.meeting_type') }}</th>
                            <th scope="col">{{ __('committee::delegate_meeting.meeting_date') }}</th>
                            <th scope="col">{{ __('committee::delegate_meeting.meeting_subject') }}</th>
                            <th scope="col">{{ __('committee::delegate_meeting.meeting_location') }}</th>
                            <th scope="col">{{ __('committee::delegate_meeting.meeting_action') }}</th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $meeting->type->name }}</td>
                            <td>{{ $meeting->meeting_at. ' ' . $meeting->from  . ' ' . $meeting->to }}</td>
                            <td>{{ $meeting->reason }}</td>
                            <td>{{ $meeting->room->name }}</td>
                            <td>
                                <div class="form-group {{ $errors->has('status') || $errors->has('refuse_reason') ? ' has-error' : '' }}">
                                    <div class="btn-group">
                                        <label class="btn btn-primary">
                                            <input type="radio" id="OptioinAccept"
                                                   value="{{ \Modules\Committee\Entities\MeetingDelegate::ACCEPTED }}"
                                                   name="status"
                                                   {{ $meetingDelegate->pivot->status == \Modules\Committee\Entities\MeetingDelegate::ACCEPTED ? ' checked ':'' }}
                                                   autofocus="true"/> {{__('committee::delegate_meeting.accept')}}
                                        </label>
                                    </div>
                                    <div class="btn-group">
                                        <label class="btn btn-primary">
                                            <input type="radio" id="optionApologize"
                                                   value="{{ \Modules\Committee\Entities\MeetingDelegate::REJECTED }}"
                                                   {{ $meetingDelegate->pivot->status == \Modules\Committee\Entities\MeetingDelegate::REJECTED?' checked ':'' }}
                                                   name="status"/> {{__('committee::delegate_meeting.apologize')}}
                                        </label>
                                    </div>
                                    {{
                                        Form::text('refuse_reason', $meetingDelegate->pivot->refuse_reason, array(
                                        'maxlength' => 191,
                                        $meetingDelegate->pivot->status == \Modules\Committee\Entities\MeetingDelegate::ACCEPTED ? ' disabled ':'',
                                        'id'=>'refuse_reason','placeholder' =>  __('committee::delegate_meeting.refuse_reason'),
                                        'class' => 'form-control'))
                                    }}
                                    @include('layouts.dashboard.form-error', ['key' => 'status'])
                                    @include('layouts.dashboard.form-error', ['key' => 'refuse_reason'])

                                </div>
                            </td>

                        </tr>
                        </tbody>
                    </table>

                </div>

            </div>
            <hr>
             <div class="row" style="border: #d6a329 solid 1px;padding: 20px;border-radius: 5px;">
                <div class="col-md-4">        
                    <label class="underLine">{{ __('committee::delegate_meeting.delegate_driver') }}</label>
                </div>
                <div class="col-md-8">
                        <div class="actions item-fl item-mb20">
                            <a  class="btn btn-sm btn-info" style="float: left;margin-left: 10%;background-color: rgb(5, 125, 84);" data-toggle="modal"
                    data-target="#addDelegateModal">
                        {{ __('messages.add') }}
                    </a>
                        </div>
                </div>    
                <div class="row">
                    <div class="col-md-12">
                        <table style="width: 100%" class="table table-bordered mt-10">
                            <thead>
                            <tr>
                                <th scope="col">اسم السائق</th>
                                <th scope="col">رقم الهوية/الاقامة</th>
                                <th scope="col">الجنسية</th>
                                <th scope="col">الديانة</th>
                            </tr>
                            </thead>
                            <div class="form-group {{ $errors->has('status') || $errors->has('refuse_reason') ? ' has-error' : '' }}">
                                <div class="btn-group">
                                    <label class="btn btn-primary">
                                        <input type="radio" id="optionNo" value="" onclick="javascript:noCheck();" name="status" checked/> لا
                                    </label>
                                </div>
                                <div class="btn-group">
                                    <label class="btn btn-primary">
                                        <input type="radio" id="OptioinYes" value="" name="status" onclick="javascript:yesCheck();" autofocus="true"/> نعم
                                    </label>
                                </div>                                 
                                @include('layouts.dashboard.form-error', ['key' => 'status'])
                                @include('layouts.dashboard.form-error', ['key' => 'refuse_reason'])
                            </div>
                            <div class="col-md-4" id="driver-form">
                                <div id="div_main_driver_of_delegate" class="form-group {{ $errors->has('driver_id') ? ' has-error' : '' }}">
                                    <form id="addDriversForm">
                                        <label for="driver_of_delegate" class="control-label">
                                            اسم السائق 
                                            <span style="color: red">*</span>
                                        </label>
                                        {!! Form::select('driver_id', [], $driverOptions, ['id' => 'driver_id', 'class' => 'form_control select2-ajax-search', 'driver-url' => route('drivers.search_by_name')]) !!}
                                    </form>
                                </div>
                                <div class="actions item-fl item-mb20">
                                    <button type="button"  class="btn btn-primary" id="getDelegateDrivers"
                                    data-url="{{ route('drivers.get_by_name') }}" >إضافة</button>
                        
                                </div>
                            </div>
                            <tbody id="drivers" ></tbody>
                        </table>
                        
                    </div>
                </br>
                </br>

            </div>
            <hr>
            <label class="underLine">{{ __('committee::delegate_meeting.meeting_attachements') }}</label>

            <div class="row">
                <div class="col-md-12">
                    <table style="width: 100%" class="table table-bordered mt-10">
                        <thead>
                        <tr>
                            <th scope="col">{{ __('committee::committees.number') }}</th>
                            <th scope="col">{{ __('committee::committees.file description') }}</th>
                            <th scope="col">{{ __('committee::committees.options') }}</th>
                        </tr>
                        </thead>
                        <tbody id="files">
                        @foreach($meeting->documents as $document)
                            <tr id="file-{{ $document->id }}">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $document->description ? $document->description:''}}</td>

                                <td>
                                    <a class="btn btn-info"
                                       href="{{ $document->full_path }}">{{ __('committee::delegate_meeting.show') }}</a>

                                    <form style="display: inline" method="get" action="{{$document->name}}">
                                        <a class="btn btn-info" download="{{$document->name}}"
                                           href="{{ $document->full_path }}">{{ __('committee::delegate_meeting.download') }}</a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>
            <label class="underLine">{{ __('committee::delegate_meeting.my_multimedia') }}</label>
            <div id="multimedia" style="border: #d6a329 solid 1px;padding: 20px;border-radius: 5px;">
                @foreach($meeting->multimedia as $multimedia)
                    {{ Form::textarea(null, $multimedia->text, ['id' => 'text'.$multimedia->id, 'rows' => 2, 'cols' => 54,'style'=>'width:100%']) }}
                    <label> {{__('committee::delegate_meeting.multimedia_date') . ' : ' . $multimedia->updated_at}}</label>
                    <hr style="margin-top: 5px;margin-bottom: 5px">
                @endforeach
                <a id="btnAddMedia" class="btn btn-success">{{ __('committee::delegate_meeting.add_multimedia') }}</a>


            </div>

            <hr>

            <p class="underLine">الملفات</p>
            <div class="row">
                <div class="col-md-5">
                    <div class="col-md-4">
                        {!! Form::label('tasks',  __('committee::committees.file description'), ['class' => 'control-label']) !!}
                    </div>

                    <div class="col-md-8">
                        {!! Form::text('file_description', null, ['id' => 'file_description', 'class' => 'form_control']) !!}
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="col-md-3">
                        <label>
                            <button type="button" id="upload-file" class="btn btn-warning">
                                رفع
                            </button>
                        </label>
                    </div>
                    <div class="col-md-9">
                        <span id="fileName"></span>
                        <div class="hidden">
                            <input type="file" name="uploadedFile" id="upload-file-browse">
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <button type="button" data-order="{{ $documentsByDelegate->count() }}" class="btn btn-primary" id="saveDelegateFiles"
                            data-url="{{ route('committee.meeting-document.store-delegate', compact('committee', 'meeting')) }}">إضافة</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <table style="width: 100%" class="table table-bordered mt-10">
                        <thead>
                        <tr>
                            <th scope="col">{{ __('committee::committees.number') }}</th>
                            <th scope="col">{{ __('committee::committees.file description') }}</th>
                            <th scope="col">{{ __('committee::committees.file path') }}</th>
                            <th scope="col">{{ __('committee::committees.options') }}</th>
                        </tr>
                        </thead>
                        <tbody id="delegateFiles">
                        @foreach($meeting->documents as $document)
                            <tr id="file-{{ $document->id }}">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>jsahdjhs</td>

                                <td>
                                    <a class="btn btn-info"
                                       href="{{ $document->full_path }}">{{ __('committee::delegate_meeting.show') }}</a>

                                    <form style="display: inline" method="get" action="{{$document->name}}">
                                        <a class="btn btn-info" download="{{$document->name}}"
                                           href="{{ $document->full_path }}">{{ __('committee::delegate_meeting.download') }}</a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>


            <div class="row">
                <div class="form-actions">
                    {{ Form::button(__('messages.save'), ['type' => 'submit', 'class' => 'btn blue item-fl item-mt20', 'id' => 'save-delegate-meeting']) }}
                </div>
            </div>

            {{ Form::close() }}
        </div>

    </div>
    @include('committee::meetings.delegates.driver_create_popup',compact('committee'))

@endsection


@section('scripts_2')
    @include('committee::meetings.delegates.scripts')
    <script>
        window.onload = function() {
            document.getElementById('driver-form').style.display = 'none';
        }
        function yesCheck() {
            if (document.getElementById('OptioinYes').checked) {
                document.getElementById('driver-form').style.display = 'block';
                
            } 
            else if(document.getElementById('optionNo').checked) {
                document.getElementById('driver-form').style.display = 'none';
                
            }   
        }
        function noCheck() {
        if(document.getElementById('optionNo').checked) {
            document.getElementById('driver-form').style.display = 'none';
            }
        if(document.getElementById('OptioinYes').checked) {
            document.getElementById('driver-form').style.display = 'block';
            }
        }
    </script>
@endsection