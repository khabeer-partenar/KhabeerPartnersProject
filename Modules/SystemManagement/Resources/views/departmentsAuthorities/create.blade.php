@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">
            
            <div class="row">
            
                <div class="col-md-9"> 
                    <div class="caption">
                        <i class="fa fa-plus"></i>
                        <span class="caption-subject sbold">{{ __('systemmanagement::systemmanagement.addNewdepartmentAuthoritiesType') }}</span>
                    </div>
                </div>
                
                <div class="col-md-3"> 
                    <div class="actions" style="float:left;">
                        <a href="{{ route('system-management.departments-authorities.index') }}" class="btn btn-primary">{{ __('messages.goBack') }}</a>
                    </div>
                </div>

            </div>
        
        </div>

        <div class="portlet-body form">
            <br>
            {{ Form::open(['route' => 'system-management.departments-authorities.store', 'method' => 'POST']) }}
                
                @if($errors->any())
                    <div class="alert alert-danger">{{ __('messages.error_message') }}</div>
                @endif

                <div class="form-body">
                    @include('systemmanagement::departmentsAuthorities.form')
                </div>

                <div class="form-actions">
                    {{ Form::button(__('messages.add'), ['type' => 'submit', 'class' => 'btn btn-primary item-fl']) }}
                </div>

            {{ Form::close() }}

        </div>
       

    </div>
@endsection