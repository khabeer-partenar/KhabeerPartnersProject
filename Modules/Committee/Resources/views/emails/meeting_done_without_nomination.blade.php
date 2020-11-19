@extends('email.layout')

@section('content')
    <h4>{{ __('committee::committees.meeting_done_without_have_nomination_alert') }}</h4>
    <a target="_blank" href="{{ route('committees.show', compact('committee')) }}" class="btn btn-green no-decoration">
        {{ route('committees.show', compact('committee')) }}
    </a>
@endsection
