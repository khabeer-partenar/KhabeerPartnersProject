@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="row">
                
                <div class="col-md-9">
                    <div class="caption">
                        <i class="fa fa-eye"></i>
                        <span class="caption-subject sbold">{{ __('committee::meetings.information') }}</span>
                        @if(!$meeting->completed)
                            <span class="caption-subject sbold">({{ __('committee::meetings.uncompleted') }})</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="actions item-fl item-mb20">
                        @if(!$meeting->trashed() && !$meeting->is_old)
                            <a href="{{ route('committee.meetings.edit', compact('committee', 'meeting')) }}" class="btn btn-sm btn-warning">
                                <i class="fa fa-edit"></i> {{ __('committee::committees.edit') }}
                            </a>
                        @endif
                        <a href="{{ route('committee.meetings', compact('committee')) }}" class="btn red">{{ __('messages.goBack') }}</a>
                    </div>
                </div>

            </div>

        </div>

        <div class="portlet-body">

            <table class="table table-striped table-responsive-md">
                <tbody>
                    <tr>
                        <th style="width: 16.66%" scope="row">نوع الإجتماع</th>
                        <td>
                            {{ $meeting->type ? $meeting->type->name:'' }}
                        </td>
                    </tr>
                    <tr>
                        <th style="width: 16.66%" scope="row">وقت الإجتماع</th>
                        <td>
                            {{ $meeting->meeting_at_ar }}
                            من
                            {{ $meeting->from }}
                            إلي
                            {{ $meeting->to }}
                        </td>
                    </tr>
                    <tr>
                        <th style="width: 16.66%" scope="row">الصالة</th>
                        <td>
                            {{ $meeting->room ? $meeting->room->name:'' }}
                        </td>
                    </tr>
                    <tr>
                        <th style="width: 16.66%" scope="row">موضوع الإجتماع</th>
                        <td>
                            {{ $meeting->reason }}
                        </td>
                    </tr>
                </tbody>
            </table>

            @php $ownerDocuments = $meeting->documents()->where('owner', 1)->get(); @endphp
            @if ($ownerDocuments->count() > 0)
            <label class="underLine">المرفقات</label>

            <div class="row">
                <div class="col-md-12">
                    <table style="width: 100%" class="table table-bordered mt-10">
                        <thead>
                        <tr>
                            <th scope="col">{{ __('committee::committees.number') }}</th>
                            <th scope="col">{{ __('committee::committees.file description') }}</th>
                            <th scope="col">{{ __('committee::committees.file path') }}</th>
                        </tr>
                        </thead>
                        <tbody id="files">
                            @foreach($ownerDocuments as $document)
                                <tr id="file-{{ $document->id }}">
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $document->description ? $document->description:''}}</td>
                                    <td>
                                        <a href="{{ $document->full_path }}">{{ $document->name }}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
            <hr>

            {{-- Participants --}}
            <div class="row">
                <div class="col-md-6">
                    <p>المندوبين المدعوين لحضور الإجتماع</p>
                    <table style="width: 100%" class="table table-bordered">
                        <thead>
                        <tr style="font-weight:bold">
                            <th scope="col">اسم المندوب</th>
                            <th scope="col">الجهة</th>
                            <th scope="col">حالة الدعوة</th>
                            <th scope="col">سبب الإعتذار</th>
                            @if($meeting->attendance_done)
                                <th scope="col">حالة الحضور</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody id="">
                        @foreach($meeting->delegates as $delegate)
                            <tr>
                                <td>{{ $delegate->name }}</td>
                                <td>{{ $delegate->department->name }}</td>
                                <td>
                                    {{ __('committee::meetings.' . \Modules\Committee\Entities\MeetingDelegate::STATUS[$delegate->pivot->status]) }}
                                </td>
                                <td>{{ $delegate->pivot->status == \Modules\Committee\Entities\MeetingDelegate::REJECTED ? $delegate->pivot->refuse_reason:'' }}</td>
                                @if ($meeting->attendance_done)
                                    <td>
                                        {{ $delegate->pivot->attended ? __('committee::meetings.attended'):__('committee::meetings.absent') }}
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <p>المستشارين المشاركين من هيئة الخبراء لحضور الإجتماع</p>
                    <div style="border: #d6a329 solid 1px;padding: 20px;border-radius: 5px;">
                        @foreach($meeting->participantAdvisors as $advisor)
                            <p style="font-size: 14px">
                                {{ $advisor->name }}
                                @if($meeting->attendance_done)
                                    <span class="badge" style="{{ $advisor->pivot->attended ? 'background-color: #009247;':'background-color: #e73d4a' }}">
                                        {{  $advisor->pivot->attended ? __('committee::meetings.attended'):__('committee::meetings.absent')}}
                                    </span>
                                @endif
                            </p>
                        @endforeach
                    </div>
                </div>
            </div>

            <hr>

            <label class="underLine">مرئيات المشاركين</label>

            @include('committee::meetings._partials.multimedia', ['delegates' => $meeting->delegates])

        </div>
    </div>
@endsection
