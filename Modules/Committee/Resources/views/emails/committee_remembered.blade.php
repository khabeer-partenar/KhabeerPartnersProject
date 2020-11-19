@extends('email.layout')

@section('content')
    <h4>
        {{ __('committee::notifications.urgent_committee_users_remembered') }}
    </h4>
    <h4> {{ __('committee::notifications.urgent_committee_notification',
         ['number' => $committee->resource_staff_number, 'date' => $meeting->meeting_at, 'hall'=> $meeting->room->name, 'day' => $day]) }}</h4>

    <a target="_blank" href="{{ route('committees.show', compact('committee')) }}" class="btn btn-green no-decoration">
        {{ route('committees.show', compact('committee')) }}
    </a>
@endsection
