@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="row">
                <div class="col-md-9">
                    <div class="caption">
                        <i class="fa fa-plus"></i>
                        <span class="caption-subject sbold">{{ __('users::employees.add_action') }}</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="actions item-fl item-mb20">
                        <a href="{{ route('employees.index') }}" class="btn red">{{ __('messages.goBack') }}</a>
                    </div>
                </div>
            </div>
        
        </div>

        <div class="portlet-body form">
            
            {{ Form::open(['route' => 'employees.store', 'method' => 'POST']) }}
                
                @if($errors->any())
                    <div class="alert alert-danger">{{ __('messages.error_message') }}</div>
                @endif

                <div class="form-body">
                    @include('users::employees.form')
                </div>

                <div class="form-actions">
                    {{ Form::button(__('messages.add'), ['type' => 'submit', 'class' => 'btn btn-primary item-fl item-mt10']) }}
                </div>

            {{ Form::close() }}

        </div>
       

    </div>
@endsection