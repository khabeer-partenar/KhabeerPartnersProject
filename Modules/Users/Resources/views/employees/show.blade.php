@extends('layouts.dashboard.index')

@section('page')

    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="caption">
                <i class="fa fa-eye"></i>
                <span class="caption-subject sbold">{{ __('users::employees.information_action') }}</span>
            </div>
            
            <div class="actions">
                @if(auth()->user()->hasPermissionWithAccess('edit'))
                    <a href="{{ route('employees.edit', $employee) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> {{ __('users::employees.edit_action') }}</a>
                @endif
            </div>
        
        </div>

        <div class="portlet-body form">
            
            <div class="form-body">

                {{ Form::model($employee, ['id' => 'diable-form-fields']) }}
                    @include('users::employees.form')
                {{ Form::close() }}

            </div>

        </div>
       

    </div>
    
    @if(auth()->user()->hasPermissionWithAccess('secretaries'))
        @includeWhen($employee->hasAdvisorsGroup(), 'users::employees.secretaries.show')
    @endif

@endsection