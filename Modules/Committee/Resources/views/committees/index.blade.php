@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="row">

                <div class="col-md-9">
                    <div class="caption">
                        <i class="fa fa-users"></i>
                        <span class="caption-subject sbold">{{ __('committee::committees.manage') }}</span>
                    </div>
                </div>

                @if(auth()->user()->hasPermissionWithAccess('create'))
                    <div class="col-md-3">
                        <div class="actions item-fl item-mb20">
                            <a href="{{ route('committees.create') }}"
                               class="btn btn-primary">{{ __('committee::committees.action_add') }}</a>
                        </div>
                    </div>
                @endif

            </div>

        </div>


        <div class="portlet-body">

            @include('committee::committees.search')

            <br>

            @if(auth()->user()->hasPermissionWithAccess('exported'))
                <ul class="nav nav-tabs">
                    <li class="nav-item {{ app()->request->route()->getName() == 'committees.index' ? 'active':'' }}">
                        <a href="{{ route('committees.index') }}" class="nav-link active">تحت الإجراء</a>
                    </li>
                    <li class="nav-item {{ app()->request->route()->getName() == 'committees.exported' ? 'active':'' }}">
                        <a href="{{ route('committees.exported') }}" class="nav-link">مصدرة</a>
                    </li>
                </ul>
            @endif

            <div class="table-responsive">
                <table class="table">
                    <thead>

                    <tr role="row">
                        @if(auth()->user()->authorizedApps->key != \Modules\Users\Entities\Employee::ADVISOR)
                            <th></th>
                            <th>
                                {{ __('committee::committees.committee id') }} <br/>
                                {{ __('committee::committees.committee created at') }}
                            </th>
                            <th>
                                {{ __('committee::committees.committee uuid') }} <br/>
                                {{ __('committee::committees.committee subject') }}
                            </th>
                            <th>
                                {{ __('committee::committees.advisor') }} <br/>
                                {{ __('committee::committees.members count') }}
                            </th>
                            <th>{{ __('committee::committees.president_id') }}</th>
                            <th>{{ __('committee::committees.status') }}</th>
                            <th>{{ __('committee::committees.options') }}</th>
                        @else
                            <th></th>
                            <th>
                                {{ __('committee::committees.committee id') }} <br/>
                                {{ __('committee::committees.committee created at') }}
                            </th>
                            <th>
                                {{ __('committee::committees.committee uuid') }} <br/>
                                {{ __('committee::committees.committee subject') }}
                            </th>
                            <th>
                                {{ __('committee::committees.advisor') }} <br/>
                                {{ __('committee::committees.members count') }}
                            </th>
                            <th>{{ __('committee::committees.president_id') }}</th>
                            <th>{{ __('committee::committees.status') }}</th>
                            <th>{{ __('committee::committees.advisor_status') }}</th>
                            <th>{{ __('committee::committees.options') }}</th>
                        @endif
                    </tr>

                    </thead>
                    <tbody>

                    @if(auth()->user()->authorizedApps->key != \Modules\Users\Entities\Employee::ADVISOR)

                        @foreach($committees as $key => $committee)
                            <tr>
                                <td>
                                    @include('committee::committees.status_icons')
                                </td>
                                <td>
                                    {{ __('committee::committees.committee number') }}
                                    : {{ $committee->treatment_number }} <br>
                                    {{ \Carbon\Carbon::parse($committee->created_at) }}
                                </td>
                                <td>
                                    {{ $committee->uuid }} <br>
                                    {{ $committee->subject }}
                                </td>
                                <td>
                                    {{ __('committee::committees.advisor_only') }} {{ $committee->advisor_name }} <br>
                                    {{ __('committee::committees.member') }} {{ $committee->members_count }}
                                </td>
                                <td>
                                    {{ $committee->president_name ? $committee->president_name : '-' }}
                                </td>
                                @if(auth()->user()->user_type == \Modules\Users\Entities\Coordinator::TYPE)
                                    <td>
                                        {{ $committee->counter ==$committee->nominated?'تم الترشيح':'لم يتم الترشيح'}}
                                    </td>
                                @else
                                    <td>
                                        {{ $committee->group_status }}
                                    </td>
                                @endif

                                <td>
                                    @if(!$committee->exported)
                                        @include('committee::committees.actions')
                                    @else
                                        @include('committee::committees.exported.actions')
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    @else

                        @foreach($committees as $key => $committee)
                            <tr>
                                <td>
                                    @include('committee::committees.status_icons')
                                </td>
                                <td>
                                    {{ __('committee::committees.committee number') }}
                                    : {{ $committee->treatment_number }} <br>
                                    {{ $committee->created_at}}
                                </td>
                                <td>
                                    {{ $committee->uuid }} <br>
                                    {{ $committee->subject }}
                                </td>
                                <td>
                                    {{ __('committee::committees.advisor_only') }} {{ $committee->advisor_name }} <br>
                                    {{ __('committee::committees.member') }} {{ $committee->members_count }}
                                </td>
                                <td>
                                    {{ $committee->president_name ? $committee->president_name : '-' }}
                                </td>

                                @if(auth()->user()->job_role_id == \Modules\Users\Entities\Coordinator::TYPE)
                                    <td>
                                        {{ $committee->counter ==$committee->nominated?'تم الترشيح':'لم يتم الترشيح'}}

                                    </td>
                                @else
                                    <td>
                                        {{ $committee->group_status }}
                                    </td>
                                @endif

                                <td>
                                    {{ $committee->advisor_id == auth()->id() ? __('committee::committees.committee advisor') : __('committee::committees.committee participant') }}
                                </td>
                                <td>
                                    @if(!$committee->exported)
                                        @include('committee::committees.actions')
                                    @else
                                        @include('committee::committees.exported.actions')
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    @endif


                    @if($committees->count() == 0)
                        <tr>
                            <td colspan="8">
                                <center>لاتوجد معاملات في المجلد</center>
                            </td>
                        </tr>
                    @endif

                    </tbody>
                </table>
            </div>


            {{ $committees->links() }}

        </div>

    </div>
@endsection

@section('scripts_2')
    @include('committee::committees.scripts')
@endsection
