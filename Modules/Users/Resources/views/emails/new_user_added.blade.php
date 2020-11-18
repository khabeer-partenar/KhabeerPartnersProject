@extends('email.layout')

@section('content')
    <h4>
        {{ __('users::general.user_added_to_system') }}
    </h4>
    <a target="_blank" href="{{ route('index') }}" class="btn btn-green no-decoration">
        {{ route('index') }}
    </a> {{ __('users::general.system_path') }}
    <h4>
        {{__('users::general.absher_login')}}
    </h4>
@endsection
