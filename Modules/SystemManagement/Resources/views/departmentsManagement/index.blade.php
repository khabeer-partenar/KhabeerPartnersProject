@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">
            
            <div class="row">

                <div class="col-md-9">
                    <div class="caption">
                        <i class="fa fa-bars"></i>
                        <span class="caption-subject sbold">{{ __('systemmanagement::systemmanagement.departmentsManagement') }}</span>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="actions" style="float:left;">
                        @if(auth()->user()->hasPermissionWithAccess('departmentsManagementCreate'))
                            <a href="{{ route('system-management.departments-management.create') }}" class="btn btn-primary">{{ __('messages.add') }}</a>
                        @endif
                    </div>
                </div>

            </div>
        
        </div>

        <div class="portlet-body">
            
            @include('systemmanagement::departmentsManagement.search')

            <div class="table-responsive">
                <table class="table">
                    <thead>

                        <tr role="row">
                            <th>{{ __('systemmanagement::systemmanagement.departmentManagementParentName') }}</th>
                            <th>{{ __('systemmanagement::systemmanagement.departmentManagementName') }}</th>
                            <th>{{ __('systemmanagement::systemmanagement.departmentManagementReferenceName') }}</th>
                            <th></th>
                        </tr>

                    </thead>
                    <tbody>
                        
                        @foreach($departmentsData as $key => $departmentData)
                            <tr>
                                <td>{{ $departmentData->name }}</td>
                                <td>{{ @$departmentData->parent->name }}</td>
                                <td>{{ (!$departmentData->is_reference && $departmentData->reference_id != 0 ? @$departmentData->referenceDepartment->name : '---') }}</td>
                                <td>
                                    @if(auth()->user()->hasPermissionWithAccess('updateOrder'))
                                        <a class="btn btn-sm btn-primary change_dept_order custom-action-btn" data-backend-url={{ route('system-management.departments.updateOrder', $departmentData) }} data-action="up">
                                            <i class="fa fa-arrow-up" aria-hidden="true"></i>
                                        </a>

                                        <a class="btn btn-sm btn-primary change_dept_order custom-action-btn" data-backend-url={{ route('system-management.departments.updateOrder', $departmentData) }} data-action="down">
                                            <i class="fa fa-arrow-down" aria-hidden="true"></i>
                                        </a>
                                    @endif
                                    
                                    @if(auth()->user()->hasPermissionWithAccess('departmentsManagementEdit'))
                                        <a href="{{ route('system-management.departments-management.edit', $departmentData) }}" class="btn btn-sm btn-warning custom-action-btn">
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
                                <td colspan="4"><center>لا يوجد بيانات</center></td>
                            </tr>
                        @endif

                    
                    </tbody>
                </table>
            </div>

            {{ $departmentsData->links() }}

        </div>

    </div>
@endsection


@section('scripts_2')
    @include('systemmanagement::shared.scripts')
@endsection