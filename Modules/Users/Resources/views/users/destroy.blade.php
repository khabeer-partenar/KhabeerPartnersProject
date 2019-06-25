@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="caption">
                <i class="fa fa-user"></i>
                <span class="caption-subject sbold">{{ __('users::users.delete_action') }}</span>
            </div>
            
            <div class="actions">
                <a href="{{ route('users.index') }}" class="btn blue">{{ __('messages.goBack') }}</a>
            </div>
        
        </div>

        <div class="portlet-body form">
            
            {{ Form::model($userData, ['route' => ['users.destroy', $userData], 'method' => 'delete']) }}
                
                <div class="alert alert-danger">{{ __('messages.destroyـconfirmation') }}</div>

                <div class="form-actions">
                    {{ Form::button(__('messages.delete'), ['type' => 'submit', 'class' => 'btn red']) }}
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