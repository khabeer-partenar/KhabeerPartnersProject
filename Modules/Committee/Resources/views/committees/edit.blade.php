@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">
            
            <div class="row">

                <div class="col-md-9">
                    <div class="caption">
                        <i class="fa fa-edit"></i>
                        <span class="caption-subject sbold">{{ __('committee::committees.edit_co') }}</span>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="actions item-fl item-mb20">
                        <a href="{{ route('committees.index') }}" class="btn red">{{ __('messages.goBack') }}</a>
                    </div>
                </div>

            </div>

        </div>


        <div class="portlet-body form">

            {{ Form::model($committee, ['route' => ['committees.update', $committee], 'method' => 'PUT', 'id' => 'committee-form']) }}

            @if($errors->any())
                <div class="alert alert-danger">{{ __('messages.error_message') }}</div>
            @endif

            <div class="form-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('committee uuid', __('committee::committees.committee uuid'), ['class' => 'ontrol-label']) !!}

                            <input class="form_control" value="{{ $committee->uuid }}" disabled>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('committee date', __('committee::committees.committee date'), ['class' => 'control-label']) !!}

                            <input class="form_control" value="{{ $committee->created_at_hijri }}" disabled>
                        </div>
                    </div>
                </div>

                @include('committee::committees.form')
            </div>

            <div class="form-actions">
                {{ Form::button(__('messages.save'), ['type' => 'submit', 'class' => 'btn blue item-fl item-mt20', 'id' => 'save-committee']) }}
            </div>

            {{ Form::close() }}

        </div>


    </div>
@endsection


@section('scripts_2')
    @include('committee::committees.scripts')
@endsection