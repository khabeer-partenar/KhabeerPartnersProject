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
                <table class="table">
                    <thead>
                        <tr role="row">
                            <th></th>
                            <th>نوع الإجتماع</th>
                            <th>موضوع الإجتماع</th>
                            <th>تاريخ و وقت الإجتماع</th>
                            <th>مكان الإجتماع</th>
                            <th>عدد المجتمعين</th>
                            <th>خيارات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($meetings as $meeting)
                            <tr>
                                <td>
                                    <div align="center">
                                        @if (!$meeting->completed)
                                            <i class="fa fa-2x fa-question-circle-o" aria-hidden="true"></i>
                                        @else
                                            <i class="fa fa-2x fa-calendar" aria-hidden="true"></i>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $meeting->type ? $meeting->type->name:'' }}</td>
                                <td>{{ $meeting->reason }}</td>
                                <td>
                                    {{ $meeting->meeting_at }} <br>
                                    {{ $meeting->from . ' - ' . $meeting->to }}
                                </td>
                                <td>{{ $meeting->room ? $meeting->room->name:'' }}</td>
                                <td>{{ count($meeting->participantAdvisors) + count($meeting->delegates) }}</td>
                                <td>
                                    <a href="{{ auth()->user()->authorizedApps->key == \Modules\Users\Entities\Delegate::JOB ?
                                        route('committees.meetings.delegate.show', compact('committee', 'meeting'))
                                       :route('committee.meetings.show', compact('committee', 'meeting')) }}"
                                       class="btn btn-success">تفاصيل الإجتماع</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>

    </div>
@endsection
