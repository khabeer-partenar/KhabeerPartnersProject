@extends('email.layout')

@section('content')
    <h4>
        {{ __('users::delegates.new delegate has been created with subject') }}
    </h4>
    <h4>{{ $delegate->name }}</h4>
   {{-- <a target="_blank" href="{{ route('committees.show', compact('committee')) }}" class="btn btn-green no-decoration">
        {{ __('committee::committees.show') }}
    </a>--}}
@endsection
