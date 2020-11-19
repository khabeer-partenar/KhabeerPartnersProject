@extends('email.layout')

@section('content')
    <h4>
        {{ __('committee::committees.committee_nomination_advisors', ['number' => $committee->resource_staff_number, 'department'=> $department]) }}
    </h4>
    <a target="_blank" href="{{ route('committees.show', compact('committee')) }}" class="btn btn-green no-decoration">
        {{ route('committees.show', compact('committee')) }}
    </a>
@endsection
