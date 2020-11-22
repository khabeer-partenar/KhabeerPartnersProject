@extends('email.layout')

@section('content')

    <h4> {{ __('committee::notifications.coming_meeting_soon_notification',
         ['number' => $committee->resource_staff_number, 'date' => $meeting->meeting_at, 'hall'=> $meeting->room->name, 'day' => $day]) }}</h4>

    <a target="_blank" href="{{ route('committees.meetings.delegate.show', compact('committee','meeting')) }}" class="btn btn-green no-decoration">
        {{ route('committees.meetings.delegate.show', compact('committee','meeting')) }}
    </a>
@endsection
