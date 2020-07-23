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

                <div class="">
                    {{ Form::submit(__('messages.sign_in'), ['class' => 'btn btn-login green uppercase']) }}
                    <a class="btn btn-login red uppercase" href="{{route('saml2_login', ['idpName' => 'iam'])}}" type="button">{{__('messages.sso_sign_in')}}</a>

                </div>

            {!! Form::close() !!}
            <br>
            @if (Session::has('sso_login_error'))
                <div class="alert alert-danger ">
                    <button class="close" data-close="alert"></button>
                    <span >{!! Session::get('sso_login_error') !!}</span>
                </div>
            @endif
            <!-- END LOGIN FORM -->

        </div>

    </div>
@endsection
