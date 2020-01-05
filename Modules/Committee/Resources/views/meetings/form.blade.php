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
                @foreach($types as $id => $name)
                    <option value="{{ $id }}" {{ old('type_id') == $id ? 'selected':'' }}>{{ $name }}</option>
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
                <option value="0"><?php echo e(__('committee::committees.please choose')); ?></option>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected':'' }}>{{ $room->name . ' - ' . $room->city->name }}</option>
                @endforeach
            </select>
            @include('layouts.dashboard.form-error', ['key' => 'room_id'])
        </div>
    </div>

    <div class="col-md-2">
        <label class="control-label"></label>
        <button class="btn btn-default" type="button"
                id="getRoomDetails" data-url="{{ route('system-management.meetings-rooms.room-with-meetings') }}"
                {{ old('room_id') ? '':'disabled' }}
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
            <input type="text" name="at" id="at" value="{{ old('at') }}" class="form_control date-picker" autocomplete="off">
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
            <input data-default-time="false"
                   data-show-meridian="false"
                   data-template="false"
                   type="text" name="from"
                   id="from" value="{{ old('from') }}"
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
            <input data-default-time="false"
                   data-show-meridian="false"
                   data-template="false"
                   type="text" name="to"
                   id="to" value="{{ old('to') }}"
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

            {!! Form::text('reason', null, ['id' => 'reason', 'class' => 'form_control']) !!}
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
        <button type="button" data-order="{{ $documents->count() }}" class="btn btn-primary" id="saveFiles"
                data-url="{{ route('committee.meeting-document.store', compact('committee')) }}">إضافة</button>
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
            @if(isset($meeting))
                @foreach($meeting->documents as $meeting)
                    <tr id="file-{{ $document->id }}">
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $document->description ? $document->description:''}}</td>
                        <td>
                            <a href="{{ $document->full_path }}">{{ $document->name }}</a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger file-remove"
                                    data-remove-url="{{ route('committees.delete-document', $document) }}"
                                    data-remove-row="#file-{{ $document->id }}">
                                حذف
                            </button>
                        </td>
                    </tr>
                @endforeach
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
                    <th style="width:7%" scope="col"><input type="checkbox" id="checkAllDelegates"></th>
                    <th scope="col">الكل</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id="">
                @foreach($committee->delegates as $delegate)
                    <tr>
                        <td><input type="checkbox" name="delegates[]" value="{{ $delegate->id }}"></td>
                        <td>{{ $delegate->name }}</td>
                        <td>{{ $delegate->department->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-6">
        <p>اختر المشاركين من هيئة الخبراء لحضور الإجتماع</p>
        <div style="border: #d6a329 solid 1px;padding: 20px;border-radius: 5px;">
            <input type="checkbox" id="all"> <span style="font-size: 14px">الكل</span> <br>
            @foreach($committee->participantAdvisors as $advisor)
                <input type="checkbox" name="participantAdvisors[]" value="{{ $advisor->id }}"> <span style="font-size: 14px">{{ $advisor->name }}</span><br>
            @endforeach
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
