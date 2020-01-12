@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="caption">
                <i class="fa fa-users"></i>
                <span class="caption-subject sbold">{{ __('users::employees.assignCommittees.title') }}</span>
            </div>
            
            <div class="actions" style="margin-bottom: 20px;">
            </div>
        
        </div>

        <div class="portlet-body">

            @include('users::employees.assign_committees.search')

            <table class="table">
                <thead>

                    <tr role="row">
                        <th>{{ __('messages.name') }}</th>
                        <th>{{ __('users::employees.assignCommittees.deptname') }}</th>
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
                                @if(auth()->user()->hasPermissionWithAccess('edit'))
                                    <a href="{{ route('employees.assign_committees.edit', $employeeData) }}" class="btn btn-sm btn-warning custom-action-btn">
                                        <i class="fa fa-edit"></i> {{ __('messages.edit') }}
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

            {{ $employeesData->links() }}

        </div>
       

    </div>
@endsection