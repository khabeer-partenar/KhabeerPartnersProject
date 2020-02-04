@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="row">

                <div class="col-md-9">
                    <div class="caption">
                         <span class="caption-subject sbold">{{ __('committee::committees.meetings_attendance') }}</span>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="actions item-fl item-mb20">
                        <a href="{{ route('committee.meetings', compact('committee')) }}"
                           class="btn red">{{ __('messages.goBack') }}</a>
                    </div>
                </div>

            </div>

        </div>

        <div class="portlet-body form">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-12">
                        <table style="width: 100%" class="table table-bordered">
                            <thead>
                            <tr style="font-weight:bold">
                                <th style="width:7%" scope="col">
                                    <input type="checkbox" id="checkAllDelegates" class="checkInContainer" data-container="#delegatesDiv">
                                </th>
                                <th scope="col">نوع الإجتماع
                                    <br> تاريخ الإجتماع
                                </th>
                                <th scope="col">حالة الدعوة</th>
                                <th scope="col">حالة الحضور</th>
                                <th scope="col">اسم المندوب</th>
                                <th scope="col">الجهة</th>
                                <th scope="col">سبب الإعتذار</th>
                            </tr>
                            </thead>
                            <tbody id="delegatesDiv" class="containerUnCheckAll" data-checker="#checkAllDelegates">
                            @foreach($committee->meetings as $meeting)
                                @foreach($meeting->delegates as $delegate)
                                    <tr>
                                        <td>
                                            <div class="form-group {{ $errors->has('delegates.*') ? ' has-error' : '' }}">
                                                <input type="checkbox"
                                                       name="delegates[]"
                                                       value="{{ $delegate->id }}"
                                                >
                                            </div>
                                        </td>
                                        <td>
                                            {{ $meeting->type->name }}
                                            <br>
                                            {{ $meeting->meeting_at }}
                                        </td>
                                        <td>
                                            {{ __('committee::meetings.' . \Modules\Committee\Entities\MeetingDelegate::STATUS[$delegate->pivot->status]) }}
                                        </td>
                                        <td>
                                            @if ($delegate->pivot->attended == null)
                                                {{ '-' }}
                                            @else
                                                {{ $delegate->pivot->attended ? __('committee::meetings.attended'):__('committee::meetings.absent') }}
                                            @endif
                                        </td>
                                        <td>{{ $delegate->name }}</td>
                                        <td>{{ $delegate->department->name }}</td>
                                        <td>
                                            {{ $delegate->pivot->status == \Modules\Committee\Entities\MeetingDelegate::REJECTED ? $delegate->pivot->refuse_reason:'' }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection


@section('scripts_2')
    @include('committee::meetings.scripts')
@endsection