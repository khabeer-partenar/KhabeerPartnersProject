@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">
            <div class="row">

                <div class="col-md-9">
                    <div class="caption">
                        <i class="fa fa-users"></i>
                        <span class="caption-subject sbold">{{ __('users::employees.title') }}</span>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="actions item-fl item-mb20">
                        @if(auth()->user()->hasPermissionWithAccess('create'))
                            <a href="{{ route('employees.create') }}" class="btn btn-primary">{{ __('messages.add') }}</a>
                        @endif
                    </div>
                </div>

            </div>
        </div>

        <div class="portlet-body">

            @include('users::employees.search')

            <br>
            <div class="table-responsive">
                <table class="table">
                    <thead>

                        <tr role="row">
                            <th>{{ __('messages.name') }}</th>
                            <th>{{ __('messages.deptname') }}</th>
                            <th>{{ __('users::employees.contact_options') }}</th>
                            <th>{{ __('users::employees.job_role_id') }}</th>
                            <th></th>
                        </tr>

                    </thead>
                    <tbody>
                        
                        @foreach($employeesData as $key => $employeeData)
                            <tr>
                                <td>{{ $employeeData->name }}</td>
                                <td>{{ @$employeeData->directDepartment->name }}</td>
                                <td>
                                    {{ $employeeData->phone_number }} <br> 
                                    {{ $employeeData->email }}
                                </td>
                                <td>{{ @$employeeData->jobRole->name }}</td>
                                <td>
                                    <!-- @if(auth()->user()->hasPermissionWithAccess('upgrateToSuperAdmin'))
                                        <a href="{{ route('employees.upgrate_to_super_admin', $employeeData) }}" class="btn btn-sm btn-primary custom-action-btn">
                                            <i class="fa fa-key"></i> Admin
                                        </a>
                                    @endif -->

                                    @if(auth()->user()->hasPermissionWithAccess('show'))
                                        <a href="{{ route('employees.show', $employeeData) }}" class="btn btn-sm btn-danger custom-action-btn">
                                            <i class="fa fa-eye"></i> {{ __('users::employees.information_btn') }}
                                        </a>
                                    @endif

                                    @if(auth()->user()->hasPermissionWithAccess('destroy'))
                                        <a data-href="{{ route('employees.destroy', $employeeData) }}" class="btn btn-sm btn-danger delete-row custom-action-btn">
                                            <i class="fa fa-trash"></i> {{ __('users::employees.delete_btn') }}
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                        @if($employeesData->count() == 0)
                            <tr>
                                <td colspan="5"><center>لا يوجد بيانات</center></td>
                            </tr>
                        @endif

                    
                    </tbody>
                </table>
            </div>

            {{ $employeesData->links() }}

        </div>
       

    </div>
@endsection