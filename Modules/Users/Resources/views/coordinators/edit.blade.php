@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">
            
            <div class="row">
                <div class="col-md-9">
                    <div class="caption">
                        <i class="fa fa-edit"></i>
                        <span class="caption-subject sbold">{{ __('users::coordinators.edit_co') }}</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="actions item-fl item-mb20">
                        <a href="{{ route('coordinators.index') }}" class="btn btn-primary">{{ __('messages.goBack') }}</a>
                    </div>
                </div>
            </div>
        
        </div>

        <div class="portlet-body form">

            {{ Form::model($coordinator, ['route' => ['coordinators.update', $coordinator], 'method' => 'PUT', 'id' => 'co-form']) }}

                @if($errors->any())
                    <div class="alert alert-danger">{{ __('messages.error_message') }}</div>
                @endif

                <div class="form-body">
                    @include('users::coordinators.form')
                </div>

                <div class="form-actions">
                    {{ Form::button(__('messages.save'), ['type' => 'submit', 'class' => 'btn btn-primary item-fl item-mt10']) }}
                </div>

            {{ Form::close() }}

        </div>
       

    </div>
@endsection


@section('scripts_2')
    @include('users::coordinators.scripts')
@endsection