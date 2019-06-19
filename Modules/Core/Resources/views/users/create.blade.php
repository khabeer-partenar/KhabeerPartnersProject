@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="caption">
                <i class="fa fa-user"></i>
                <span class="caption-subject sbold">{{ __('core::users.action_add') }}</span>
            </div>
            
            <div class="actions">
                <a href="{{ route('core.users.index') }}" class="btn red confirm-message">{{ __('messages.goBack') }}</a>
            </div>
        
        </div>

        <div class="portlet-body form">
            
            {{ Form::open(['route' => 'core.users.store', 'method' => 'POST']) }}
                
                @if($errors->any())
                    <div class="alert alert-danger">{{ __('messages.error_message') }}</div>
                @endif

                <div class="form-body">
                    @include('core::users.form')
                </div>

                <div class="form-actions">
                    {{ Form::button(__('messages.add'), ['type' => 'submit', 'class' => 'btn blue']) }}
                </div>

            {{ Form::close() }}

        </div>
       

    </div>
@endsection


@section('scripts_2')

    <script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>

@endsection