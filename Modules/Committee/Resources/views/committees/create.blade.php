@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="caption">
                <i class="fa fa-plus"></i>
                <span class="caption-subject sbold">{{ __('committee::committees.add_co') }}</span>
            </div>

            <div class="actions">
                <a href="{{ route('committees.index') }}" class="btn red">{{ __('messages.goBack') }}</a>
            </div>

        </div>

        <div class="portlet-body form">

            {{ Form::open(['route' => 'committees.store', 'method' => 'POST', 'id' => 'co-form']) }}

            @if($errors->any())
                <div class="alert alert-danger">{{ __('messages.error_message') }}</div>
            @endif

            <div class="form-body">
                @include('committee::committees.form')
            </div>

            <div class="form-actions">
                {{ Form::button(__('messages.add'), ['type' => 'submit', 'class' => 'btn blue']) }}
            </div>

            {{ Form::close() }}

        </div>


    </div>
@endsection


@section('scripts_2')
    @include('committee::committees.scripts')
@endsection