@extends('layouts.dashboard.index')

@section('page')

    <div class="alert alert-danger"><strong>{{ __('index::messages.unauthorized_user') }}</strong></div>

@endsection
