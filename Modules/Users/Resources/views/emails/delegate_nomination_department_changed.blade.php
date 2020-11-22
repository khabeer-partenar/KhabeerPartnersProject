@extends('email.layout')

@section('content')

    <h4>{{__('users::delegates.replace_delegate_from_committee')  . ' ' . $delegate->name . ' '  .__('users::delegates.delegate_in_department_before', ['name' => $old_department->name])}} </h4>
    <a target="_blank" href="{{ route('committees.show', compact('committee')) }}" class="btn btn-green no-decoration">
        {{ __('committee::committees.show') }}
    </a>
@endsection
