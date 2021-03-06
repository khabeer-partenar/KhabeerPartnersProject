@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="row">

                <div class="col-md-9">
                    <div class="caption">
                        <i class="fa fa-plus"></i>
                        <span class="caption-subject sbold">{{ __('committee::meetings.create new') }}</span>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="actions item-fl item-mb20">
                        <a href="{{ route('committees.show', compact('committee')) }}" class="btn red">{{ __('committee::committees.details') }}</a>
                        <a href="{{ route('committee.meetings', compact('committee')) }}" class="btn red">{{ __('messages.goBack') }}</a>
                    </div>
                </div>



            </div>

        </div>

        <div class="portlet-body form">

            <form action="{{ route('committee.meetings.store', compact('committee')) }}" method="post" id="committee-meeting-form">

            @if($errors->any())
                <div class="alert alert-danger">{{ __('messages.error_message') }}</div>
            @endif

            <div class="form-body">
                @include('committee::meetings.form')
            </div>

            <div class="form-actions">
                {{ Form::button(__('messages.add'), ['type' => 'submit', 'class' => 'btn blue item-fl item-mt20', 'id' => 'save-committee']) }}
            </div>

            </form>
        </div>


    </div>
@endsection


@section('scripts_2')
    @include('committee::meetings.scripts')
@endsection
