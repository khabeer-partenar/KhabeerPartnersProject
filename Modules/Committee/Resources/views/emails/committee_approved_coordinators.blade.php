@extends('email.layout')

@section('content')
    <h4>
        {{ __('committee::committees.approved') }}
    </h4>
    <h4>
        <a target="_blank" href="{{ route('committees.show', $committee) }}" class="btn btn-green no-decoration">
            {{ route('committees.show', $committee) }}
        </a>
        {{ __('committee::notifications.committee_approved_coordinators') }}
    </h4>
@endsection
