@extends('layouts.auth.index')


@section('page')

    <div class="app_inner_pages_bg" style="height: 100%;position: fixed;width: 100%;">

        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="{{ url('/') }}">
                <img src="/assets/img/mu-login-logo.png" alt="" />
            </a>
        </div>
        <!-- END LOGO -->

        <!-- BEGIN LOGIN -->
        <div class="content app_inner_pages_container" style="min-height:auto;">
            
            <!-- BEGIN LOGIN FORM -->
            {{ Form::open(['route' => 'login', 'class' => 'login-form', 'method' => 'POST']) }}
                <h3 class="form-title font-green">{{ __('messages.sign_in')}}</h3>
            
                @if (session('error_login'))
                    <div class="alert alert-danger">
                        <button class="close" data-close="alert"></button>
                        <span>{{ __('messages.login_error_message') }}</span>
                    </div>
                @endif
                
                <div class="form-group">
                    <label class="control-label">{{ __('messages.national_id') }}</label>
                    {{ Form::text('national_id', old('national_id') , ['class' => 'form_control form_control-solid placeholder-no-fix', 'required' => true, 'placeholder' => __('messages.national_id')]) }}
                </div>

                <div class="form-group">
                    <label class="control-label">{{ __('messages.password') }}</label>
                    {{ Form::password('password', ['class' => 'form_control form_control-solid placeholder-no-fix', 'required' => true, 'placeholder' => __('messages.password')]) }}
                </div>
            
                <div class="form-actions">
                    {{ Form::submit(__('messages.sign_in'), ['class' => 'btn green uppercase']) }}
                </div>
            
            {!! Form::close() !!}
            <!-- END LOGIN FORM -->
        
        </div>
        
    </div>
@endsection