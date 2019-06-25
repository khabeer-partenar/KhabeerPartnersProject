@extends('layouts.dashboard.index')

@section('page')

    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="caption">
                <i class="fa fa-eye"></i>
                <span class="caption-subject sbold">{{ __('users::users.information_action') }}</span>
            </div>
            
            <div class="actions">
                <a href="{{ route('users.edit', $user) }}" class="btn blue"><i class="fa fa-edit"></i> {{ __('users::users.edit_action') }}</a>
            </div>
        
        </div>

        <div class="portlet-body form">
            
            <div class="form-body">

                {{ Form::model($user, ['id' => 'diable-form-fields']) }}
                    @include('users::users.form')
                {{ Form::close() }}

            </div>

        </div>
       

    </div>
    
    @includeWhen($user->hasAdvisorsGroup(), 'users::users.secretaries.show', compact('secretariesUsersData'))

@endsection