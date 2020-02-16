@extends('email.layout')

@section('content')
    <h4>
        {{ __('committee::notifications.meeting_come_soon_remember') }}
    </h4>
    <h4>{{ $committee->subject }}</h4>
    <a target="_blank" href="{{ route('committees.meetings.delegate.show', compact('committee','meeting')) }}" class="btn btn-green no-decoration">
        {{ __('committee::committees.show') }}
    </a>
@endsection
