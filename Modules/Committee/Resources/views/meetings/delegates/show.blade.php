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
                @foreach($meeting->userMultimedia as $multimedia)
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
                    <button type="button" data-order="{{ $documentsByDelegate->count() }}" class="btn btn-primary" id="saveFiles"
                            data-url="{{ route('committee.meeting-document.store-meeting', compact('committee', 'meeting')) }}">إضافة</button>
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
                        @foreach($documentsByDelegate as $document)
                            <tr id="file-{{ $document->id }}">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $document->description ? $document->description:''}}</td>
                                <td>
                                    <a href="{{ $document->full_path }}">{{ $document->name }}</a>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger file-remove"
                                            data-remove-url="{{ route('committees.delete-document', $document) }}"
                                            data-remove-row="#file-{{ $meeting->id }}">
                                        حذف
                                    </button>
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
@endsection


@section('scripts_2')
    @include('committee::meetings.delegates.scripts')
@endsection