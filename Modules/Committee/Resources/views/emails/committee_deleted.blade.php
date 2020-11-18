@extends('email.layout')

@section('content')
    <h4>
        {{ __('committee::committees.committee deleted') }}
    </h4>
    <h4>
        <a target="_blank" href="{{ route('index') }}" class="btn btn-green no-decoration">
            {{ route('index') }}
        </a>
        {{__('committee::notifications.committee_deleted_desc', ['number' => $committee->resource_staff_number])}}</h4>
@endsection
