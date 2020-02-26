@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="row">

                <div class="col-md-9">
                    <div class="caption">
                        <i class="fa fa-users"></i>
                        <span class="caption-subject sbold">{{ __('committee::committees.meetings') }}</span>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="actions item-fl item-mb20">
                        @if(auth()->user()->hasPermissionWithAccess('create'))
                            <a href="{{ route('committee.meetings.create', compact('committee')) }}"
                               class="btn btn-primary">{{ __('committee::meetings.action_add') }}</a>
                        @endif
                        <a href="{{ route('committees.index') }}" class="btn red">{{ __('messages.goBack') }}</a>
                    </div>
                </div>

            </div>

        </div>

        <div class="portlet-body">

            <br>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr role="row">
                            <th></th>
                            <th>نوع الإجتماع</th>
                            <th>موضوع الإجتماع</th>
                            <th>تاريخ و وقت الإجتماع</th>
                            @if (
                                auth()->user()->user_type != \Modules\Users\Entities\Coordinator::TYPE &&
                                auth()->user()->user_type != \Modules\Users\Entities\Delegate::TYPE
                            )
                                <th>مكان الإجتماع</th>
                                <th>عدد المجتمعين</th>
                            @endif
                            @if (auth()->user()->user_type == \Modules\Users\Entities\Delegate::TYPE)
                                <th>حالة الدعوة</th>
                            @endif
                            <th>خيارات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($meetings as $meeting)
                            <tr>
                                <td>
                                    <div align="center">
                                        @if (!$meeting->completed)
                                            <i title="{{ __('committee::meetings.not_completed') }}"
                                               class="fa fa-2x fa-question-circle-o" style="color: #d6a329;" aria-hidden="true"></i>
                                        @elseif (auth()->user()->user_type == \Modules\Users\Entities\Delegate::TYPE &&
                                        in_array(auth()->id(), $meeting->absentDelegates->pluck('delegate_id')->toArray()))
                                            <i title="{{ __('committee::meetings.apologised') }}"
                                               class="fa fa-2x fa-calendar-times-o" style="color: #e73d4a" aria-hidden="true"></i>
                                        @elseif (($meeting->deleted_at))
                                            <i title="{{ __('committee::meetings.cancelled') }}"
                                               class="fa fa-2x fa-calendar-times-o" style="color: #e73d4a" aria-hidden="true"></i>
                                        @elseif($meeting->toDate > \Carbon\Carbon::now())
                                            <i title="{{ __('committee::meetings.incoming') }}"
                                               class="fa fa-2x fa-calendar" aria-hidden="true"></i>
                                        @elseif($meeting->toDate <= \Carbon\Carbon::now())
                                            <i title="{{ __('committee::meetings.finished') }}"
                                               class="fa fa-2x fa-calendar-check-o" style="color: #009247" aria-hidden="true"></i>

                                        @endif
                                    </div>
                                </td>
                                <td>{{ $meeting->type ? $meeting->type->name:'' }}</td>
                                <td>{{ $meeting->reason }}</td>
                                <td>
                                    {{ $meeting->meeting_at }} <br>
                                    {{ $meeting->from . ' - ' . $meeting->to }}
                                </td>
                                @if (
                                        auth()->user()->user_type != \Modules\Users\Entities\Coordinator::TYPE &&
                                        auth()->user()->user_type != \Modules\Users\Entities\Delegate::TYPE
                                )
                                    <td>{{ $meeting->room ? $meeting->room->name:'' }}</td>
                                    <td>{{ count($meeting->attendingDelegates) + count($meeting->attendingAdvisors) }}</td>
                                @endif
                                @if (auth()->user()->user_type == \Modules\Users\Entities\Delegate::TYPE)
                                    <td>
                                        @if (in_array(auth()->id(), $meeting->attendingDelegates->pluck('delegate_id')->toArray()))
                                            {{ __('committee::meetings.accepted') }}
                                        @elseif(in_array(auth()->id(), $meeting->absentDelegates->pluck('delegate_id')->toArray()))
                                            {{ __('committee::meetings.rejected') }}
                                        @else
                                            {{ __('committee::meetings.invited') }}
                                        @endif
                                    </td>
                                @endif
                                <td>
                                    @include('committee::meetings.actions')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
