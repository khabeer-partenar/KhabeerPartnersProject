@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="row">
                <div class="col-md-9">
                    <div class="caption">
                        <i class="fa fa-bars"></i>
                        <span class="caption-subject sbold">{{ __('systemmanagement::systemmanagement.departmentsTypes') }}</span>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="actions" style="float:left;">
                        @if(auth()->user()->hasPermissionWithAccess('departmentsTypesCreate'))
                            <a href="{{ route('system-management.departments-types.create') }}" class="btn btn-primary">{{ __('messages.add') }}</a>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        <div class="portlet-body">
            
            @include('systemmanagement::departmentsTypes.search')
            
            <table class="table">
                <thead>

                    <tr role="row">
                        <th>{{ __('systemmanagement::systemmanagement.departmentTypeName') }}</th>
                        <th></th>
                    </tr>

                </thead>
                <tbody>
                    
                    @foreach($departmentsData as $key => $departmentData)
                        <tr>
                            <td>{{ $departmentData->name }}</td>
                            <td>
                                @if(auth()->user()->hasPermissionWithAccess('updateOrder'))
                                    <a class="btn btn-sm btn-primary change_dept_order custom-action-btn" data-backend-url={{ route('system-management.departments.updateOrder', $departmentData) }} data-action="up">
                                        <i class="fa fa-arrow-up" aria-hidden="true"></i>
                                    </a>

                                    <a class="btn btn-sm btn-primary change_dept_order custom-action-btn" data-backend-url={{ route('system-management.departments.updateOrder', $departmentData) }} data-action="down">
                                        <i class="fa fa-arrow-down" aria-hidden="true"></i>
                                    </a>
                                @endif
                                
                                @if(auth()->user()->hasPermissionWithAccess('departmentsTypesEdit'))
                                    <a href="{{ route('system-management.departments-types.edit', $departmentData) }}" class="btn btn-sm btn-warning custom-action-btn">
                                        <i class="fa fa-edit"></i> {{ __('systemmanagement::systemmanagement.edit_btn') }}
                                    </a>
                                @endif
                                
                                @if(auth()->user()->hasPermissionWithAccess('destroy'))    
                                    <a data-href="{{ route('system-management.departments.destroy', $departmentData) }}" class="btn btn-sm btn-danger delete-row custom-action-btn">
                                        <i class="fa fa-trash"></i> {{ __('systemmanagement::systemmanagement.delete_btn') }}
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    @if($departmentsData->count() == 0)
                        <tr>
                            <td colspan="2"><center>لا يوجد بيانات</center></td>
                        </tr>
                    @endif

                
                </tbody>
            </table>

            {{ $departmentsData->links() }}
            
        </div>
       

    </div>
@endsection

@section('scripts_2')
    @include('systemmanagement::shared.scripts')
@endsection