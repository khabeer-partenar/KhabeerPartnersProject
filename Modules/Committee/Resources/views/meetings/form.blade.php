@csrf

@foreach($errors as $error)
    <p>{{ $error }}</p>
@endforeach

<div class="row">
    {{-- Type --}}
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('type_id') ? ' has-error' : '' }}">
            <label for="type_id" class="control-label">
                {{ __('committee::meetings.type') }}
                <span style="color: red">*</span>
            </label>
            <select name="type_id" id="type_id" class="form_control select2">
                <option value="0">{{ __('committee::committees.please choose') }}</option>
                @php
                $typeId = isset($meeting) ? $meeting->type_id:null;
                if (old('type_id')){
                    $typeId = old('type_id');
                }
                @endphp
                @foreach($types as $id => $name)
                    <option value="{{ $id }}" {{ $typeId == $id ? 'selected':'' }}>{{ $name }}</option>
                @endforeach
            </select>
            @include('layouts.dashboard.form-error', ['key' => 'type_id'])
        </div>
    </div>

    {{-- Room --}}
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('room_id') ? ' has-error' : '' }}">
            <label for="room_id" class="control-label">
                {{ __('committee::meetings.room') }}
                <span style="color: red">*</span>
            </label>
            <select name="room_id" id="room_id" class="form_control select2">
                <option value="0">{{ __('committee::committees.please choose') }}</option>
                @php
                    $roomId = isset($meeting) ? $meeting->room_id:null;
                    if (old('room_id')){
                        $roomId = old('room_id');
                    }
                @endphp
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}" {{ $roomId == $room->id ? 'selected':'' }}>{{ $room->name . ' - ' . $room->city->name }}</option>
                @endforeach
            </select>
            @include('layouts.dashboard.form-error', ['key' => 'room_id'])
        </div>
    </div>

    <div class="col-md-2">
        <label class="control-label"></label>
        <button class="btn btn-default" type="button"
                id="getRoomDetails" data-url="{{ route('system-management.meetings-rooms.room-with-meetings') }}"
                {{ $roomId ? '':'disabled' }}
        >تفاصيل عن الصالة</button>
    </div>
</div>

<div class="row">
    {{-- Meeting Date --}}
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('at') ? ' has-error' : '' }}">
            <label for="at" class="control-label">
                {{ __('committee::meetings.at') }}
                <span style="color: red">*</span>
            </label>
            @php
                $meetingAt = isset($meeting) ? \Carbon\Carbon::parse($meeting->meeting_at)->format('m/d/Y'):null;
                if (old('at')){
                    $meetingAt = old('at');
                }
            @endphp
            <input type="text" name="at" id="at" value="{{ $meetingAt }}" class="form_control date-picker" autocomplete="off">
            @include('layouts.dashboard.form-error', ['key' => 'at'])
        </div>
    </div>
    {{-- From --}}
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('from') ? ' has-error' : '' }}">
            <label for="from" class="control-label">
                {{ __('committee::meetings.from') }}
                <span style="color: red">*</span>
            </label>
            @php
                $from = isset($meeting) ? $meeting->from:null;
                if (old('from')){
                    $from = old('from');
                }
            @endphp
            <input data-default-time="false"
                   data-show-meridian="false"
                   data-template="false"
                   type="text" name="from"
                   id="from" value="{{ $from }}"
                   class="form_control timepicker timepicker-default" autocomplete="off">
            @include('layouts.dashboard.form-error', ['key' => 'from'])
        </div>
    </div>
    {{-- To --}}
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('to') ? ' has-error' : '' }}">
            <label for="to" class="control-label">
                {{ __('committee::meetings.to') }}
                <span style="color: red">*</span>
            </label>
            @php
                $to = isset($meeting) ? $meeting->to:null;
                if (old('to')){
                    $to = old('to');
                }
            @endphp
            <input data-default-time="false"
                   data-show-meridian="false"
                   data-template="false"
                   type="text" name="to"
                   id="to" value="{{ $to }}"
                   class="form_control timepicker timepicker-default" autocomplete="off">
            @include('layouts.dashboard.form-error', ['key' => 'to'])
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('reason') ? ' has-error' : '' }}">
            <label for="reason" class="control-label">
                {{ __('committee::meetings.reason') }}
                <span style="color: red">*</span>
            </label>
            @php
                $reason = isset($meeting) ? $meeting->reason:null;
                if (old('from')){
                    $reason = old('reason');
                }
            @endphp
            {!! Form::text('reason', $reason, ['id' => 'reason', 'class' => 'form_control']) !!}
            @include('layouts.dashboard.form-error', ['key' => 'reason'])
        </div>
    </div>
</div>

<hr>

{{-- Files --}}
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
        <button type="button"
                data-order="{{ isset($meeting) ? $meeting->documents->count():$documents->count() }}"
                class="btn btn-primary" id="saveFiles"
                data-url="{{ isset($meeting) ? route('committee.meeting-document.store-meeting',
                 compact('committee', 'meeting')):route('committee.meeting-document.store', compact('committee')) }}"
        >إضافة
        </button>
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
            <tbody id="files">
            {{-- Edit --}}
            @if(isset($meeting))
                @foreach($meeting->documents as $document)
                    <tr id="file-{{ $document->id }}">
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $document->description ? $document->description:''}}</td>
                        <td>
                            <a href="{{ $document->full_path }}">{{ $document->name }}</a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger file-remove"
                                    data-remove-url="{{ route('committee.meeting-document.delete', compact('committee', 'document')) }}"
                                    data-remove-row="#file-{{ $document->id }}">
                                حذف
                            </button>
                        </td>
                    </tr>
                @endforeach
            {{-- Create --}}
            @else
                @foreach($documents as $document)
                    <tr id="file-{{ $document->id }}">
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $document->description ? $document->description:''}}</td>
                        <td>
                            <a href="{{ $document->full_path }}">{{ $document->name }}</a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger file-remove"
                                    data-remove-url="{{ route('committee.meeting-document.delete', compact('committee', 'document')) }}"
                                    data-remove-row="#file-{{ $document->id }}">
                                حذف
                            </button>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>

<hr>

{{-- Participants --}}
<p class="underLine">قائمة المدعوين من المرشحين</p>
<div class="row">
    <div class="col-md-6">
        <p>اختر المدعوين لحضور الإجتماع</p>
        <table style="width: 100%" class="table table-bordered">
            <thead>
                <tr style="font-weight:bold">
                    <th style="width:7%" scope="col"><input type="checkbox" id="checkAllDelegates" class="checkInContainer" data-container="#delegatesDiv"></th>
                    <th scope="col">الكل</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id="delegatesDiv" class="containerUnCheckAll" data-checker="#checkAllDelegates">
                @php
                    $counter = 0;
                    $meetingDelegates = isset($meeting) ? $meetingDelegates:null;
                    if (old('delegates') && is_array(old('delegates'))){
                        $meetingDelegates = old('delegates');
                    }
                @endphp
                @foreach($committee->delegates as $delegate)
                    <tr>
                        <td>
                            <div class="form-group {{ $errors->has('delegates.*') ? ' has-error' : '' }}">
                                <input type="checkbox"
                                       name="delegates[]"
                                       value="{{ $delegate->id }}"
                                        {{ is_array($meetingDelegates) ? (in_array($delegate->id, $meetingDelegates) ? 'checked':''):'' }}>
                                @include('layouts.dashboard.form-error', ['key' => 'delegates.'.$counter])
                            </div>
                        </td>
                        <td>{{ $delegate->name }}</td>
                        <td>{{ $delegate->department->name }}</td>
                    </tr>
                    @php $counter++; @endphp
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-6">
        <p>اختر المشاركين من هيئة الخبراء لحضور الإجتماع</p>
        <div style="border: #d6a329 solid 1px;padding: 20px;border-radius: 5px;">
            <input type="checkbox" class="checkInContainer" id="checkAllAdvisors" data-container="#advisorsDiv"> <span style="font-size: 14px">الكل</span> <br>
            <div id="advisorsDiv" class="containerUnCheckAll" data-checker="#checkAllAdvisors">
                @php
                    $counter = 0;
                    $meetingAdvisors = isset($meeting) ? $meetingAdvisors:null;
                    if (old('participantAdvisors') && is_array(old('participantAdvisors'))){
                        $meetingAdvisors = old('participantAdvisors');
                    }
                @endphp
                @foreach($committee->participantAdvisors as $advisor)
                    <div class="form-group {{ $errors->has('participantAdvisors.*') ? ' has-error' : '' }}">
                        <input type="checkbox"
                               name="participantAdvisors[]"
                               value="{{ $advisor->id }}"
                                {{ is_array($meetingAdvisors) ? (in_array($advisor->id, $meetingAdvisors) ? 'checked':''):'' }}>
                        <span style="font-size: 14px">{{ $advisor->name }}</span><br>
                        @include('layouts.dashboard.form-error', ['key' => 'participantAdvisors.'.$counter])
                    </div>
                    @php $counter++; @endphp
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="roomDetailsModal" class="modal fade" role="dialog">
    <div class="modal-notify modal-info" role="document" style="overflow-y: initial !important;width: auto; margin: 5%;">

        <!-- Modal content-->
        <div class="modal-content">
            <div style="height: 50px; background-color: #057d54"
                 class="modal-header d-flex text-center justify-content-center">
                <p style="color: white" class="heading">
                    <strong>{{ __('committee::meetings.room_details') }}</strong>
                </p>
                <div class="clearfix"></div>
            </div>

            <div class="modal-body" style="height: 400px; overflow-y: auto;">
                <table class="table table-striped table-responsive-md">
                    <tbody>
                        <tr>
                            <th style="width: 16.66%" scope="row">اسم الصالة</th>
                            <td id="room_name"></td>
                        </tr>
                        <tr>
                            <th style="width: 16.66%" scope="row">المدينة</th>
                            <td id="room_city"></td>
                        </tr>
                        <tr>
                            <th scope="row">الطاقة الإستيعابية</th>
                            <td id="room_capacity"></td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-striped table-responsive-md">
                    <thead>

                    <tr style="font-weight:bold">
                        <th style="width:7%" scope="col"></th>
                        <th scope="col">{{ __('committee::meetings.day') }}</th>
                        <th scope="col">{{ __('committee::meetings.from') }}</th>
                        <th scope="col">{{ __('committee::meetings.to') }}</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="upcoming_meetings">
                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <button  type="button" class="btn btn-danger" data-dismiss="modal">{{__('users::delegates.close_window')}}</button>
            </div>
        </div>

    </div>
</div>
