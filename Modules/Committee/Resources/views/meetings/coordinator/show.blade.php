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

            <div class="row">
                <div class="col-md-12">
                    <table style="width: 100%" class="table table-bordered mt-10">
                        <thead>
                        <tr>
                            <th scope="col">{{ __('committee::delegate_meeting.meeting_type') }}</th>
                            <th scope="col">{{ __('committee::delegate_meeting.meeting_date') }}</th>
                            <th scope="col">{{ __('committee::delegate_meeting.meeting_subject') }}</th>
                            <th scope="col">{{ __('committee::delegate_meeting.meeting_location') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $meeting->type->name }}</td>
                            <td>
                                {{ $meeting->meeting_at }}
                                <br>
                                {{ 'من ' . $meeting->from  . ' إلى ' . $meeting->to  }}
                            </td>
                            <td>{{ $meeting->reason }}</td>
                            <td>{{ $meeting->room->name }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>

            <hr>

            {{-- Participants --}}
            <div class="row">
                <div class="col-md-12">
                    <p>قائمة المرشحين من الجهة</p>
                    <table style="width: 100%" class="table table-bordered">
                        <thead>
                        <tr style="font-weight:bold">
                            <th scope="col">اسم المندوب</th>
                            <th scope="col">الجهة</th>
                            @if($meeting->attendance_done)
                                <th scope="col">حالة الحضور</th>
                            @endif
                            <th scope="col">حالة الدعوة</th>
                            <th scope="col">سبب الإعتذار</th>
                            <th scope="col">خيارات</th>
                        </tr>
                        </thead>
                        <tbody id="">
                        @foreach($meetingDepartments as $department)
                            @php $delegate = $department->meetingDelegates->first() @endphp
                            <tr>
                                @if ($delegate)
                                    <td>
                                        <span title="{{ $delegate->phone_number }}">{{ $delegate->name }}</span>
                                    </td>
                                @else
                                    <td>لا يوجد مرشح</td>
                                @endif
                                <td>{{ $department->name }}</td>
                                @if ($meeting->attendance_done && $delegate)
                                    <td>
                                        @if ($delegate->pivot->status == \Modules\Committee\Entities\MeetingDelegate::REJECTED)
                                            {{ __('committee::meetings.' . \Modules\Committee\Entities\MeetingDelegate::STATUS[$delegate->pivot->status]) }}
                                        @else
                                            {{ $delegate->pivot->attended ? __('committee::meetings.attended'):__('committee::meetings.absent') }}
                                        @endif
                                    </td>
                                @endif
                                @if ($delegate)
                                    <td>{{ __('committee::meetings.' . \Modules\Committee\Entities\MeetingDelegate::STATUS[$delegate->pivot->status]) }}</td>
                                    <td>{{ $delegate->pivot->status == \Modules\Committee\Entities\MeetingDelegate::REJECTED ? $delegate->pivot->refuse_reason:'-' }}</td>
                                @else
                                    <td>-</td><td>-</td>
                                @endif
                                <td>
                                    <button
                                            {{ $delegate ? 'data-id=' . $delegate->id:'' }}
                                            data-ref-dep="{{ $department->reference_id }}"
                                            data-department="{{ $department->id }}"
                                            class="btn btn-primary update-nomination">تعديل</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal -->
    <div id="delegatesModal" class="modal fade" role="dialog">
        <div class="modal-notify modal-info" role="document" style="overflow-y: initial !important;width: auto; margin: 10% 15%;">
            <input id="nominate_path" value="{{ route('committee.meetings.nominate', compact('committee', 'meeting')) }}" hidden>
            <!-- Modal content-->
            <div class="modal-content">
                <div style="height: 50px; background-color: #057d54"
                     class="modal-header d-flex text-center justify-content-center">
                    <p style="color: white" class="heading">
                        <strong>تعديل المندوب المرشح</strong>
                    </p>
                    <div class="clearfix"></div>
                </div>
                <form id="delegates-nominations">
                    <div class="modal-body">
                        <table class="table table-bordered table-responsive-md">
                            <tbody>
                                <tr class="delegates_rows" data-dep="0">
                                    <th style="width: 16.66%" scope="row" >
                                        <input type="radio" class="delegate_id" value="0" name="delegate_id">
                                    </th>
                                    <td colspan="2">حذف المندوب من الإجتماع</td>
                                </tr>
                                @foreach($delegates as $delegate)
                                    <tr class="delegates_rows" data-dep="{{ $delegate->department->id }}">
                                        <th style="width: 16.66%" scope="row">
                                            <input type="radio" class="delegate_id" value="{{ $delegate->id }}" name="delegate_id">
                                        </th>
                                        <td>{{ $delegate->name }}</td>
                                        <td>{{ $delegate->department->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <input name="department_id" id="department_id" value="" hidden>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="save-nomination">حفظ</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">إغلاق</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection


@section('scripts_2')
    @include('committee::meetings.coordinator.scripts')
@endsection