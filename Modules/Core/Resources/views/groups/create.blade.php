@extends('layouts.dashboard.index')

@section('page')

    <div class="panel panel-info">
        
        <div class="panel-heading">{{ __('core::groups.action_add') }}</div>
        
        <div class="panel-body">
            {!! Form::model($group,['route' =>  ['groups.store'], 'method' => 'post' ]) !!}
                @include('core::groups.form')
                {{ FORM::button(__('messages.save'), ['class' => 'btn btn-lg blue', 'type' => 'submit']) }}
            {!! Form::close() !!}
      </div>
  </div>
@endsection
