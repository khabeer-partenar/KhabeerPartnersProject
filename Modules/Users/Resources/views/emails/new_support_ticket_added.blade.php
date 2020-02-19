@extends('email.layout')

@section('content')
    <h4>
        {{ __('users::support.new_support_ticket') }}
    </h4>
    <h4>{{__('users::support.support_type')}} : {{$ticket->type->title}}</h3>
    <h4>{{__('users::support.support_details')}} : {{$ticket->description}}</h4>
    <h4>{{__('users::support.request_uesr')}} : {{$user->name}}</h4>

@endsection