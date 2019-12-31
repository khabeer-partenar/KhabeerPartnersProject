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

            <table id="table-ajax" class="table" data-url="{{ route('committees.index', [
                'subject' => Request::input('subject'),
                'advisor_id' => Request::input('advisor_id'),
                'status' => Request::input('status'),
                'created_at' => Request::input('created_at'),
                'treatment_number' => Request::input('treatment_number'),
                'treatment_time' => Request::input('treatment_time'),
                'uuid' => Request::input('uuid')
                ])
            }}" data-fields='[
                   @if(auth()->user()->authorizedApps->key != \Modules\Users\Entities\Employee::ADVISOR)
                    {"data": "status_icon","name":"status_icon","title":"","searchable":"false", "orderable":"false"},
                    {"data": "id_with_date","name":"actions","title":"{{ __('committee::committees.committee id') }} <br /> {{ __('committee::committees.committee created at') }}","searchable":"false", "orderable":"false"},
                        {"data": "committee_uuid_with_subject","name":"committee_uuid_with_subject","title":"{{ __('committee::committees.committee uuid') }}<br /> {{ __('committee::committees.committee subject') }}","searchable":"false", "orderable":"false"},
                        {"data": "advisor_with_members_count","name":"advisor_with_members_count","title":"{{ __('committee::committees.advisor') }}<br /> {{ __('committee::committees.members count') }}","searchable":"false", "orderable":"false"},
                        {"data": "president","name":"president","title":"{{ __('committee::committees.president_id') }}","searchable":"false", "orderable":"false"},
                        {"data": "status","name":"status","title":"{{ __('committee::committees.status') }}","searchable":"false", "orderable":"false"},
                        {"data": "action","name":"actions","title":"{{ __('committee::committees.options') }}","searchable":"false", "orderable":"false"}
                   @else
                    {"data": "status_icon","name":"status_icon","title":"","searchable":"false", "orderable":"false"},
                    {"data": "id_with_date","name":"actions","title":"{{ __('committee::committees.committee id') }} <br /> {{ __('committee::committees.committee created at') }}","searchable":"false", "orderable":"false"},
                        {"data": "committee_uuid_with_subject","name":"committee_uuid_with_subject","title":"{{ __('committee::committees.committee uuid') }}<br /> {{ __('committee::committees.committee subject') }}","searchable":"false", "orderable":"false"},
                        {"data": "advisor_with_members_count","name":"advisor_with_members_count","title":"{{ __('committee::committees.advisor') }}<br /> {{ __('committee::committees.members count') }}","searchable":"false", "orderable":"false"},
                        {"data": "president","name":"president","title":"{{ __('committee::committees.president_id') }}","searchable":"false", "orderable":"false"},
                        {"data": "status","name":"status","title":"{{ __('committee::committees.status') }}","searchable":"false", "orderable":"false"},
                        {"data": "advisor_status","name":"advisor_status","title":" {{ __('committee::committees.advisor_status') }} ","searchable":"false", "orderable":"false"},
                        {"data": "action","name":"actions","title":"{{ __('committee::committees.options') }}","searchable":"false", "orderable":"false"}
                    @endif
                    ]'
            >
            </table>

        </div>

    </div>
@endsection

@section('scripts_2')
    @include('committee::committees.scripts')
@endsection
