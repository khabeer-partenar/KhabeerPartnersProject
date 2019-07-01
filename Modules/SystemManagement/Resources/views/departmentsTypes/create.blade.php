@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="caption">
                <i class="fa fa-plus"></i>
                <span class="caption-subject sbold">{{ __('systemmanagement::systemmanagement.addNewdepartmentType') }}</span>
            </div>
            
            <div class="actions">
                <a href="{{ route('system-management.departments-types.index') }}" class="btn red">{{ __('messages.goBack') }}</a>
            </div>
        
        </div>

        <div class="portlet-body form">
            
            {{ Form::open(['route' => 'system-management.departments-types.store', 'method' => 'POST']) }}
                
                @if($errors->any())
                    <div class="alert alert-danger">{{ __('messages.error_message') }}</div>
                @endif

                <div class="form-body">
                    @include('systemmanagement::departmentsTypes.form')
                </div>

                <div class="form-actions">
                    {{ Form::button(__('messages.add'), ['type' => 'submit', 'class' => 'btn blue']) }}
                </div>

            {{ Form::close() }}

        </div>
       

    </div>
@endsection