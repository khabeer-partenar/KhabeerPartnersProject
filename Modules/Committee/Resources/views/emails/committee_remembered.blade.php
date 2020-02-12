@extends('email.layout')

@section('content')
    <h4>
        {{ __('committee::notifications.remember_urgent_committee_users') }}
    </h4>
    <h4>{{ $committee->subject }}</h4>
    <a target="_blank" href="{{ route('committees.show', compact('committee')) }}" class="btn btn-green no-decoration">
        {{ __('committee::committees.show') }}
    </a>
@endsection
