@extends('layouts.dashboard.index')

@section('page')

    @if($errors->any())
        <div class="alert alert-danger">{{ __('messages.error_message') }}</div>
    @endif   

    <div class="portlet light bordered">

        <div class="portlet-title">
            <div class="row">

                <div class="col-md-12">
                    <div class="caption">
                        <i class="fa fa-envelope-o"></i>
                        <span class="caption-subject sbold">{{ __('users::support.create_action') }}</span>
                    </div>
                </div>

            </div>
        </div>

        <div class="portlet-body form">
             
            {{ Form::open(['route' => 'support.store', 'method' => 'POST']) }}

                <br>
                <div class="form-body">
                    @include('users::support.form')
                </div>

                <div class="form-actions">
                    {{ Form::button(__('messages.send'), ['type' => 'submit', 'class' => 'btn btn-primary  item-fl item-mt10']) }}
                </div>

            {{ Form::close() }}

        </div>
       

    </div>
@endsection

@section('scripts_2')
    @include('users::support.scripts')
@endsection