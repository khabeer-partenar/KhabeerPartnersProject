@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">
            <div class="row">
                <div class="col-md-9">
                    <div class="caption">
                        <i class="fa fa-users"></i>
                        <span class="caption-subject sbold">{{ __('committee::committees.members_multimedia') }}</span>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="actions item-fl item-mb20">
                        <a href="{{ route('committees.index') }}" class="btn red">{{ __('messages.goBack') }}</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="portlet-body">
            @include('committee::meetings._partials.multimedia', ['delegates' => $delegates])
        </div>

    </div>
@endsection
