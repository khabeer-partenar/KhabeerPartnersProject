@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="row">

                <div class="col-md-9">
                    <div class="caption">
                        <i class="fa fa-plus"></i>
                        <span class="caption-subject sbold">{{ __('committee::meetings.confirm_attendance') }}</span>
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

            <form action="{{ route('committees.meetings.attendance.store', compact('committee', 'meeting')) }}" method="post" id="committee-meeting-form">
                @csrf

                @if($errors->any())
                    <div class="alert alert-danger">{{ __('messages.error_message') }}</div>
                @endif

                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p>قائمة المرشحين من الجهات المشاركين</p>
                            <table style="width: 100%" class="table table-bordered">
                                <thead>
                                <tr style="font-weight:bold">
                                    <th style="width:7%" scope="col"><input type="checkbox" id="checkAllDelegates" class="checkInContainer" data-container="#delegatesDiv">
                                    <th scope="col">الكل</th>
                                    <th scope="col">الجهة</th>
                                    <th scope="col">الحالة</th>
                                    <th scope="col">سبب الإعتذار</th>
                                </tr>
                                </thead>
                                <tbody id="delegatesDiv" class="containerUnCheckAll" data-checker="#checkAllDelegates">
                                @php $counter = 0; @endphp
                                @foreach($meeting->delegates as $delegate)
                                    <tr>
                                        <td>
                                            <div class="form-group {{ $errors->has('delegates.*') ? ' has-error' : '' }}">
                                                <input type="checkbox"
                                                       name="delegates[]"
                                                       value="{{ $delegate->id }}"
                                                >
                                                @include('layouts.dashboard.form-error', ['key' => 'delegates.'.$counter])
                                            </div>
                                        </td>
                                        <td>{{ $delegate->name }}</td>
                                        <td>{{ $delegate->department->name }}</td>
                                        <td>
                                            {{ __('committee::meetings.' . \Modules\Committee\Entities\MeetingDelegate::STATUS[$delegate->pivot->status]) }}
                                        </td>
                                        <td>
                                            {{ $delegate->pivot->status == \Modules\Committee\Entities\MeetingDelegate::REJECTED ?
                                            $delegate->pivot->refuse_reason:'' }}
                                        </td>
                                    </tr>
                                    @php $counter++; @endphp
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <p>قائمة المشاركين من هيئة الخبراء</p>
                            <div style="border: #d6a329 solid 1px;padding: 20px;border-radius: 5px;">
                                <div class="form-group">
                                    <input type="checkbox" class="checkInContainer" id="checkAllAdvisors" data-container="#advisorsDiv">
                                    <span style="font-size: 14px">الكل</span> <br>
                                </div>
                                <div id="advisorsDiv" class="containerUnCheckAll" data-checker="#checkAllAdvisors">
                                    @php $counter = 0; @endphp
                                    @foreach($meeting->participantAdvisors as $advisor)
                                        <div class="form-group {{ $errors->has('participantAdvisors.*') ? ' has-error' : '' }}">
                                            <input type="checkbox"
                                                   name="participantAdvisors[]"
                                                   value="{{ $advisor->id }}"
                                            >
                                            <span style="font-size: 14px">{{ $advisor->name }}</span><br>
                                            @include('layouts.dashboard.form-error', ['key' => 'participantAdvisors.'.$counter])
                                        </div>
                                        @php $counter++; @endphp
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    {{ Form::button(__('messages.save'), ['type' => 'submit', 'class' => 'btn blue item-fl item-mt20', 'id' => 'save-committee']) }}
                </div>
            </form>
        </div>
    </div>
@endsection


@section('scripts_2')
    @include('committee::meetings.scripts')
@endsection