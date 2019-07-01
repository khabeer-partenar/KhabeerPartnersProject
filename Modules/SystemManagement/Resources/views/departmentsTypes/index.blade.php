@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="caption">
                <i class="fa fa-bars"></i>
                <span class="caption-subject sbold">{{ __('systemmanagement::systemmanagement.departmentsTypes') }}</span>
            </div>
            
            <div class="actions">
                {{-- @if(auth()->user()->hasPermissionWithAccess('create')) --}}
                    <a href="{{ route('employees.create') }}" class="btn btn-primary">{{ __('systemmanagement::systemmanagement.add_action') }}</a>
                {{-- @endif --}}
            </div>
        
        </div>

        <div class="portlet-body">
            
                @include('systemmanagement::departmentsTypes.search')


        </div>
       

    </div>
@endsection