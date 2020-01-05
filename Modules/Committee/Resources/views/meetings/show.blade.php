@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="row">
                
                <div class="col-md-9">
                    <div class="caption">
                        <i class="fa fa-eye"></i>
                        <span class="caption-subject sbold">{{ __('committee::committees.treatment information') }}</span>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="actions item-fl item-mb20">
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
                            {{ $meeting->type->name }}
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
                            {{ $meeting->room->name }}
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
            <label class="underLine">المرفقات</label>

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
                            @foreach($meeting->documents as $document)
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
                        </tbody>
                    </table>
                </div>
            </div>

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
                        </tr>
                        </thead>
                        <tbody id="">
                        @foreach($meeting->delegates as $delegate)
                            <tr>
                                <td>{{ $delegate->name }}</td>
                                <td>{{ $delegate->department->name }}</td>
                                <td>مدعو</td>
                                <td>كنت نايم</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <p>المستشارين المشاركين من هيئة الخبراء لحضور الإجتماع</p>
                    <div style="border: #d6a329 solid 1px;padding: 20px;border-radius: 5px;">
                        @foreach($meeting->participantAdvisors as $advisor)
                            <p style="font-size: 14px">{{ $advisor->name }}</p>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection