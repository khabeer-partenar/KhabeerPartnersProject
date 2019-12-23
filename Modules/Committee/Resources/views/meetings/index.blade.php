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

                @if(auth()->user()->hasPermissionWithAccess('create'))
                    <div class="col-md-3">
                        <div class="actions item-fl item-mb20">
                            <a href="{{ route('committee.meetings.create', compact('committee')) }}"
                               class="btn btn-primary">{{ __('committee::meetings.action_add') }}</a>
                        </div>
                    </div>
                @endif

            </div>

        </div>

        <div class="portlet-body">

            <br>

            <table id="table-ajax" class="table" data-url="" data-fields='[
                {"data": "id_with_date","name":"actions","title":"{{ __('committee::committees.committee id') }} <br /> {{ __('committee::committees.committee created at') }}","searchable":"false", "orderable":"false"},
                    {"data": "committee_uuid_with_subject","name":"committee_uuid_with_subject","title":"{{ __('committee::committees.committee uuid') }}<br /> {{ __('committee::committees.committee subject') }}","searchable":"false", "orderable":"false"},
                    {"data": "advisor_with_members_count","name":"advisor_with_members_count","title":"{{ __('committee::committees.advisor') }}<br /> {{ __('committee::committees.members count') }}","searchable":"false", "orderable":"false"},
                    {"data": "president","name":"president","title":"{{ __('committee::committees.president_id') }}","searchable":"false", "orderable":"false"},
                    {"data": "status","name":"status","title":"{{ __('committee::committees.status') }}","searchable":"false", "orderable":"false"},
                    {"data": "advisor_status","name":"advisor_status","title":" {{ __('committee::committees.advisor_status') }} ","searchable":"false", "orderable":"false"},
                    {"data": "action","name":"actions","title":"{{ __('committee::committees.options') }}","searchable":"false", "orderable":"false"}
                ]'
            >
            </table>

        </div>

    </div>
@endsection

@section('scripts_2')
    @include('committee::committees.scripts')
@endsection
