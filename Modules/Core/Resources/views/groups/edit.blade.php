@extends('layouts.dashboard.index')

@section('page')

    <div class="panel panel-info">

        <div class="panel-heading">{{ __('core::groups.edit_group_title') }}</div>

        <div class="panel-body">
            {!! Form::model($group,['route' =>  ['core.groups.update', $group->id ],'method'=>'put' ]) !!}
                @include('core::groups.form')
                {{ FORM::button(__('core::groups.action_edit'), ['class' => 'btn btn-lg blue', 'type' => 'submit']) }}
            {!! Form::close() !!}
        </div>

    </div>
  @endsection
