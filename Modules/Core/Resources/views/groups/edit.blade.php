@extends('layouts.dashboard.index')

@section('page')

    <div class="panel panel-info">

        <div class="panel-heading">{{ __('messages.edit_group_title') }}</div>

        <div class="panel-body">
            {!! Form::model($group,['route' =>  ['groups.update', $group->id ],'method'=>'put' ]) !!}
                @include('core::groups.form')
                {{ FORM::button(__('messages.save'), ['class' => 'btn btn-lg blue', 'type' => 'submit']) }}
            {!! Form::close() !!}
        </div>

    </div>
  @endsection
