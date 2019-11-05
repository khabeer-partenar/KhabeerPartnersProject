@extends('email.layout')

@section('content')
    <h4>
        {{ __('users::delegates.you added to a committee') }}
    </h4>
    <h4>{{ $committee->subject }}</h4>

    <h4>
        {{ __('users::delegates.committee first meeting date') }}
    </h4>
    <h4>{{ $committee->first_meeting_at }}</h4>

    <a target="_blank" href="{{ route('committees.show', compact('committee')) }}" class="btn btn-green no-decoration">
        {{ __('committee::committees.show') }}
    </a>
@endsection
