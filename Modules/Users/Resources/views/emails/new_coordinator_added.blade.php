@extends('email.layout')

@section('content')
    <h4>
        {{ __('users::coordinators.coordinator_added_to_system') }}
    </h4>
    <a target="_blank" href="{{ route('index') }}" class="btn btn-green no-decoration">
        {{ __('users::general.system_path') }}
    </a>
@endsection