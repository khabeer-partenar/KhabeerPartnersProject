@extends('email.layout')

@section('content')
    <h4>
        {{ __('committee::notifications.delegate_approve_attendace_message', ['number' => $committee->resource_staff_number, 'department'=> $department]) }}
    </h4>
    <a target="_blank" href="{{ route('committee.meetings.show', compact('committee','meeting')) }}" class="btn btn-green no-decoration">
        {{ route('committee.meetings.show', compact('committee','meeting')) }}
    </a>
@endsection
