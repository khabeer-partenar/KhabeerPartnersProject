@extends('email.layout')

@section('content')
    <h4>
        {{ __('committee::notifications.meeting_delegates_invitation') .  ' '  . $committee->subject}}
    </h4>
    <h4>{{ $meeting->reason }}</h4>
    <a target="_blank" href="{{ route('committee.meetings.show', compact('committee','meeting')) }}" class="btn btn-green no-decoration">
        {{ __('committee::notifications.meeting_details') }}
    </a>
@endsection
