@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="caption">
                <i class="fa fa-users"></i>
                <span class="caption-subject sbold">{{ __('committee::committees.manage') }}</span>
            </div>

            @if(auth()->user()->hasPermissionWithAccess('create'))
                <div class="actions">
                    <a href="{{ route('committees.create') }}"
                       class="btn btn-primary">{{ __('committee::committees.action_add') }}</a>
                </div>
            @endif

        </div>

        <div class="portlet-body">
            @include('committee::committees.search')

            <table id="committeesTable" class="table table-striped table-responsive-md">
                <thead>
                <tr>
                    <th style="width: 5%" scope="col"></th>
                    <th style="font-weight: bold;" scope="col">{{ __('committee::committees.committee id') }}
                        <br/> {{ __('committee::committees.committee created at') }}</th>
                    <th style="font-weight: bold;" scope="col">{{ __('committee::committees.committee uuid') }}
                        <br/> {{ __('committee::committees.committee subject') }}</th>
                    <th style="font-weight: bold;" scope="col">{{ __('committee::committees.advisor') }}
                        <br/> {{ __('committee::committees.members count') }}</th>
                    <th style="font-weight: bold;" scope="col">{{ __('committee::committees.president_id') }}</th>
                    <th style="font-weight: bold;" scope="col">{{ __('committee::committees.status') }}</th>

                    @if(auth()->user()->authorizedApps->key == \Modules\Users\Entities\Employee::ADVISOR)
                        <th style="font-weight: bold;" scope="col">{{ __('committee::committees.advisor_status') }}</th>
                    @endif

                    <th style="font-weight: bold;" scope="col">{{ __('committee::committees.options') }}</th>


                </tr>
                </thead>
                <tbody>
                @foreach($committeesQuery as $committee)
                    @php
                        $today = Carbon\Carbon::today();
                        $meetingDays =abs($committee->first_meeting_at->diffInDays($today, false));
                        $committeePeriod =abs($committee->created_at->diffInDays($today, false));

                    if ($meetingDays <= config('committee.meeting_date_alert_period'))
                    {
                        $color =config('committee.meeting_date_alert_period_color');
                    }
                    elseif ($committeePeriod <= config('committee.new_committee_color_period'))
                    {
                        $color =config('committee.new_committee_color_period_color');
                    }
                    else
                    {
                        $color =config('committee.new_committee_color_period_normal_color');

                    }

                    @endphp

                    <tr style="background-color: {{$color}}">
                        <td>{{ $loop->index + 1 }}
                        </td>
                        <td>
                            {{__('committee::committees.committee number') . $committee->treatment_number}}
                            <br> {{$committee->created_at->format('d-m-Y')}}
                        </td>
                        <td>
                            {{$committee->uuid}} <br> {{ $committee->subject}}
                        </td>
                        <td>
                            {{ __('committee::committees.advisor_only') . ' ' . $committee->advisor->name }} <br>
                            {{__('committee::committees.member') . ' ' . $committee->members_count}}
                        </td>

                        <td>
                            {{$committee->president ? $committee->president->name : '-' }}
                        </td>

                        <td>
                            {{__('committee::committees.' . $committee->status)}}
                        </td>

                        @if(auth()->user()->authorizedApps->key == \Modules\Users\Entities\Employee::ADVISOR)
                            <td>
                               {{ $committee->advisor_id == auth()->id() ?
                                __('committee::committees.committee advisor')
                                : __('committee::committees.committee participant')}}
                            </td>
                        @endif

                        <td>
                            @include('committee::committees.actions')
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            {{ $committeesQuery->links() }}
        </div>

    </div>
@endsection

@section('scripts_2')
    @include('committee::committees.scripts')
@endsection
