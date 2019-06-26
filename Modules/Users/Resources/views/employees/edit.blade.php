@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="caption">
                <i class="fa fa-user"></i>
                <span class="caption-subject sbold">{{ __('users::employees.edit_action') }}</span>
            </div>
            
            <div class="actions">
                <a href="{{ route('employees.index') }}" class="btn red">{{ __('messages.goBack') }}</a>
            </div>
        
        </div>

        <div class="portlet-body form">
            
            {{ Form::model($employee, ['route' => ['employees.update', $employee], 'method' => 'PUT']) }}
                
                @if($errors->any())
                    <div class="alert alert-danger">{{ __('messages.error_message') }}</div>
                @endif

                <div class="form-body">
                    @include('users::employees.form')
                </div>

                <div class="form-actions">
                    {{ Form::button(__('messages.save'), ['type' => 'submit', 'class' => 'btn blue']) }}
                </div>

            {{ Form::close() }}

        </div>
       

    </div>
@endsection