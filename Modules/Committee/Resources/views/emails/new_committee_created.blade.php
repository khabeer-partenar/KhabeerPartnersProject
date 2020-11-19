@extends('email.layout')

@section('content')
    <h4>{{__('committee::committees.committee_need_approve')}}</h4>
    <a target="_blank" href="{{ route('committees.show', compact('committee')) }}" class="btn btn-green no-decoration">
        {{ route('committees.show', compact('committee')) }}
    </a>
@endsection
