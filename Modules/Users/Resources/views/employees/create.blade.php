@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="caption">
                <i class="fa fa-user"></i>
                <span class="caption-subject sbold">{{ __('users::employees.add_action') }}</span>
            </div>
            
            <div class="actions">
                <a href="{{ route('employees.index') }}" class="btn red">{{ __('messages.goBack') }}</a>
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
                    {{ Form::button(__('messages.add'), ['type' => 'submit', 'class' => 'btn blue']) }}
                </div>

            {{ Form::close() }}

        </div>
       

    </div>
@endsection