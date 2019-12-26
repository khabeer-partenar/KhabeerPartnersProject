@extends('email.layout')

@section('content')
    <h4>
        {{ __('users::delegates.delegate_department_changed') . ' ' . $message }}
    </h4>
    <h4>اسم المندوب : {{ $delegate->name }} </h4>
    <a target="_blank" href="{{ route('committees.show', compact('committee')) }}" class="btn btn-green no-decoration">
        {{ __('committee::committees.show') }}
    </a>
@endsection