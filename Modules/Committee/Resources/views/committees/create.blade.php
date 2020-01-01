@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="row">
                
                <div class="col-md-9">
                    <div class="caption">
                        <i class="fa fa-plus"></i>
                        <span class="caption-subject sbold">{{ __('committee::committees.add_co') }}</span>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="actions item-fl item-mb20">
                        <a href="{{ route('committees.index') }}" class="btn btn-primary">{{ __('messages.goBack') }}</a>
                    </div>
                </div>

            </div>

        </div>

        <div class="portlet-body form">

            {{ Form::open(['route' => 'committees.store', 'method' => 'POST', 'id' => 'committee-form']) }}

            @if($errors->any())
                <div class="alert alert-danger">{{ __('messages.error_message') }}</div>
            @endif

            <div class="form-body">
                @include('committee::committees.form')
            </div>

            <div class="form-actions">
                {{ Form::button(__('messages.add'), ['type' => 'submit', 'class' => 'btn btn-primary item-fl item-mt20', 'id' => 'save-committee']) }}
            </div>

            {{ Form::close() }}

        </div>


    </div>
@endsection


@section('scripts_2')
    @include('committee::committees.scripts')
@endsection