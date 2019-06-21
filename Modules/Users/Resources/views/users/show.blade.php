@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="caption">
                <i class="fa fa-eye"></i>
                <span class="caption-subject sbold">{{ __('users::users.information_action') }}</span>
            </div>
            
            <div class="actions">
                <a href="{{ route('users.edit', $userData->id) }}" class="btn blue"><i class="fa fa-edit"></i> {{ __('users::users.edit_action') }}</a>
            </div>
        
        </div>

        <div class="portlet-body form">
            
            <div class="form-body">

                {{ Form::model($userData, ['id' => 'diable-form-fields']) }}
                    @include('users::users.form')
                {{ Form::close() }}

            </div>

        </div>
       

    </div>

    @if($userData->hasAdvisorsGroup())

        <div class="portlet light bordered">

            <div class="portlet-title">
        
                <div class="caption">
                    <i class="fa fa-users"></i>
                    <span class="caption-subject sbold">{{ __('users::users.secretaries') }}</span>
                </div>
                    
                <div class="actions">
                    <a href="{{ route('users.edit_secretaries', $userData->id) }}" class="btn blue"><i class="fa fa-edit"></i> {{ __('users::users.edit_secretaries_btn') }}</a>
                </div>
                
            </div>
        
            <div class="portlet-body form">
                    
                <div class="form-body">
                    
                </div>
        
            </div>
        
        </div>
        
    @endif


@endsection