@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="caption">
                <i class="fa fa-bars"></i>
                <span class="caption-subject sbold">{{ __('systemmanagement::systemmanagement.departmentsAuthorities') }}</span>
            </div>
            
            <div class="actions">
                @if(auth()->user()->hasPermissionWithAccess('departmentsAuthoritiesCreate'))
                    <a href="{{ route('system-management.departments-authorities.create') }}" class="btn btn-primary">{{ __('messages.add') }}</a>
                @endif
            </div>
        
        </div>

        <div class="portlet-body">
            
            @include('systemmanagement::departmentsAuthorities.search')

            <table id="table-ajax" class="table" data-url="{{ route('system-management.departments-authorities.index', [
                        'department_id' => Request::input('department_id'),
                    ])
                }}"
                data-fields='[
                    {"data": "name","title":"{{ __('systemmanagement::systemmanagement.directDeparetmentName') }}","searchable":"false"},
                    {"data": "action","name":"actions","searchable":"false", "orderable":"false"}
                ]'
            >
            </table>
        </div>
       

    </div>
@endsection


@section('scripts_2')
    @include('systemmanagement::shared.scripts')
@endsection