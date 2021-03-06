@extends('email.layout')

@section('content')
    <h4>
        {{ __('users::delegates.delegate deleted') }}
    </h4>
    <h4>{{ $delegate->name }}</h4>

    <h4>
        {{ __('users::delegates.delegate deleted for committee') }}
    </h4>
    <h4>{{ $committee->subject }}</h4>

    <h4>
        {{ __('users::delegates.delegate deleted reason') }}
    </h4>
    <h4>{{ $reason }}</h4>

    <a target="_blank" href="{{ route('committees.show', compact('committee')) }}" class="btn btn-green no-decoration">
        {{ __('committee::committees.show') }}
    </a>
@endsection
