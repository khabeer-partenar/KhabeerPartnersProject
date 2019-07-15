@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="caption">
                <i class="fa fa-edit"></i>
                <span class="caption-subject sbold">{{ __('users::coordinators.edit_co') }}</span>
            </div>
            
            <div class="actions">
                <a href="{{ route('coordinators.index') }}" class="btn red">{{ __('messages.goBack') }}</a>
            </div>
        
        </div>

        <div class="portlet-body form">

            {{ Form::model($coordinator, ['route' => ['coordinators.update_by_co', $coordinator], 'method' => 'PUT', 'id' => 'co-form']) }}

                @if($errors->any())
                    <div class="alert alert-danger">{{ __('messages.error_message') }}</div>
                @endif

                <div class="form-body">
                    @include('users::coordinators.coordinator.form')
                </div>

                <div class="form-actions">
                    {{ Form::button(__('messages.save'), ['type' => 'submit', 'class' => 'btn blue']) }}
                </div>

            {{ Form::close() }}

        </div>
       

    </div>
@endsection

@section('scripts_2')
    @include('users::coordinators.scripts')
@endsection