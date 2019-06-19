@extends('layouts.dashboard.index')

@section('page')

    <h2><i class="fa fa-users"></i> {{$model->name}}</h2>
    <core-app-wrapper
        permission-route-url="{{$routeUrl}}"
        is-permission=true
        permissionable-type="{{ $permissionableType }}"
        permissionable-id="{{ $permissionableId }}">
    </core-app-wrapper>
    
@endsection
