@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="caption">
                <i class="fa fa-edit"></i>
                <span class="caption-subject sbold">{{ __('committee::committees.edit_co') }}</span>
            </div>

            <div class="actions">
                <a href="{{ route('committees.index') }}" class="btn red">{{ __('messages.goBack') }}</a>
            </div>

        </div>

        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('committee uuid', __('committee::committees.committee uuid'), ['class' => 'col-md-4 control-label']) !!}

                <div class="col-md-8">
                    <input class="form-control" value="{{ $committee->uuid }}" disabled>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('committee date', __('committee::committees.committee date'), ['class' => 'col-md-4 control-label']) !!}

                <div class="col-md-8">
                    <input class="form-control" value="{{ $committee->created_at_hijri }}" disabled>
                </div>
            </div>
        </div>

        <div class="portlet-body form">

            {{ Form::model($committee, ['route' => ['committees.update', $committee], 'method' => 'PUT', 'id' => 'co-form']) }}

            @if($errors->any())
                <div class="alert alert-danger">{{ __('messages.error_message') }}</div>
            @endif

            <div class="form-body">
                @include('committee::committees.form')
            </div>

            <div class="form-actions">
                {{ Form::button(__('messages.save'), ['type' => 'submit', 'class' => 'btn blue']) }}
            </div>

            {{ Form::close() }}

        </div>


    </div>
@endsection


@section('scripts_2')
    @include('committee::committees.scripts')
@endsection