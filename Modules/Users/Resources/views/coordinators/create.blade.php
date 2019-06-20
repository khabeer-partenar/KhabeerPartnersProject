@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="caption">
                <i class="fa fa-user"></i>
                <span class="caption-subject sbold">{{ __('users::coordinators.action_add') }}</span>
            </div>
            
            <div class="actions">
                <a href="{{ route('coordinators.index') }}" class="btn red confirm-message">{{ __('messages.goBack') }}</a>
            </div>
        
        </div>

        <div class="portlet-body form">
            
            {{ Form::open(['route' => 'coordinators.store', 'method' => 'POST']) }}
                
                @if($errors->any())
                    <div class="alert alert-danger">{{ __('messages.error_message') }}</div>
                @endif

                <div class="form-body">
                    @include('users::coordinators.form')
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
        $(document).ready(function () {
            $('.select2').select2();

            $('.load-departments').change(function () {
                console.log($(this).val());
                let path = $(this).attr('data-url') + '?parentId=' + $(this).val();
                let child = $(this).attr('data-child');
                // Empty Children
                $(child).empty();
                if ($(child).hasClass('load-departments')) {
                    let childOfChild = $(child).attr('data-child');
                    $(childOfChild).empty();
                }
                if ($(this).val() != 0){
                    $.ajax({
                        url: path,
                        success: function (response) {
                            let select = $(child)[0];
                            let length = Object.keys(response).length;
                            for (let index = 0; index < length; index++) {
                                select.options[select.options.length] = new Option(response[index].name, response[index].id);
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection