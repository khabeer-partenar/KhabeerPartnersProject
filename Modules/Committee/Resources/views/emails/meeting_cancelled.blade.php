@extends('email.layout')

@section('content')
    <h4>
        {{ __('committee::notifications.meeting_cancelled') .  ' '  . $committee->subject}}
    </h4>
    <h4>{{ $meeting->reason }}</h4>
@endsection
