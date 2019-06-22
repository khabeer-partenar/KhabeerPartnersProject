@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="caption">
                <i class="fa fa-edit"></i>
                <span class="caption-subject sbold">{{ __('users::users.edit_secretaries_title') }}: {{ $userData->name }}</span>
            </div>
            
            <div class="actions">
                <a href="{{ route('users.show', $userData->id) }}" class="btn red confirm-message">{{ __('messages.goBack') }}</a>
            </div>
        
        </div>

        <div class="portlet-body form">
            
            {{ Form::model($userData, ['route' => ['users.update_secretaries', $userData->id], 'method' => 'PUT']) }}
                
                @if($errors->any())
                    <div class="alert alert-danger">{{ __('messages.error_message') }}</div>
                @endif

                <div class="form-body">
                    
                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('secretaries_ids') ? ' has-error' : '' }}">
                                {!! Form::select('secretaries_ids[]', $secretariesUsers, null, ['id' => 'secretaries_ids', 'multiple' => 'multiple']) !!}
                                                    
                                @if ($errors->has('secretaries_ids'))
                                    <span class="help-block" ><strong>{{ $errors->first('secretaries_ids') }}</strong></span>
                                @endif
                            </div>
                        </div>
                            
                    </div>

                </div>

                <div class="form-actions">
                    {{ Form::button(__('messages.save'), ['type' => 'submit', 'class' => 'btn blue']) }}
                </div>

            {{ Form::close() }}

        </div>
       

    </div>
@endsection


@section('scripts_2')

    <style>
        .multiselect_title {
            padding-bottom: 10px;
            
        }
    </style>

    <script>
    $(document).ready(function() {

        $("#secretaries_ids").val({{$secretariesIDs}});

        $('#secretaries_ids').multiSelect({
            selectableHeader: "<div class='multiselect_title'>{{ __('users::users.secretaries_selected') }}</div>",
            selectionHeader: "<div class='multiselect_title'>{{ __('users::users.secretaries_unselected') }}</div>",
        });

    });
    </script>
@endsection