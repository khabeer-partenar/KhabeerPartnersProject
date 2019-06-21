@extends('layouts.dashboard.index')

@section('page')

    <core-users
        can-create-new-user="{{ auth()->user()->hasPermissionWithAccess('store') }}"
        can-upgrate-user-to-super-admin="{{ auth()->user()->hasPermissionWithAccess('upgrateToSuperAdmin') }}"
    />

@endsection
