@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="row">

                <div class="col-md-9">
                    <div class="caption">
                        <i class="fa fa-edit"></i>
                        <span class="caption-subject sbold">{{ __('systemmanagement::systemmanagement.editDepartmentManagement') }}</span>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="actions" style="float:left;">
                        <a href="{{ route('system-management.departments-management.index') }}" class="btn red">{{ __('messages.goBack') }}</a>
                    </div>
                </div>

            </div>
        </div>

        <div class="portlet-body form">
            <br>
            {{ Form::model($department, ['route' => ['system-management.departments-management.update', $department], 'method' => 'put']) }}

                @if($errors->any())
                    <div class="alert alert-danger">{{ __('messages.error_message') }}</div>
                @endif

                <div class="form-body">
                    @include('systemmanagement::departmentsManagement.form')
                </div>

                <div class="form-actions">
                    {{ Form::button(__('messages.save'), ['type' => 'submit', 'class' => 'btn blue item-fl']) }}
                </div>

            {{ Form::close() }}

        </div>
       

    </div>
@endsection