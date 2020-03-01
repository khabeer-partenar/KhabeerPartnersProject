@extends('email.layout')

@section('content')
    <h4>
        {{ __('committee::committees.approved') }}
    </h4>
    <h4>{{ $committee->subject }}</h4>
@endsection
