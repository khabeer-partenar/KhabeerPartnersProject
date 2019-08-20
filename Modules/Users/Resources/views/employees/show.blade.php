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
                    <a href="{{ route('employees.edit', $employee) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> {{ __('messages.edit') }}</a>
                @endif
            </div>
        
        </div>
        
        <div class="portlet-body form">
            <table class="table table-striped table-responsive-md">
                <thead>
                    <tr>
                        <th style="width: 16.666%" scope="col">#</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">{{ __('users::employees.department_type') }}</th>
                        <td>{{ $employee->mainDepartment->name }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('users::employees.parent_department_id') }}</th>
                        <td>
                            {{ $employee->parentDepartment->name }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('users::employees.direct_department_id') }}</th>
                        <td>{{ $employee->directDepartment->name }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('users::employees.national_id') }}</th>
                        <td>{{ $employee->national_id }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('users::employees.name') }}</th>
                        <td>{{ $employee->name }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('users::employees.phone_number') }}</th>
                        <td>{{ $employee->phone_number }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('users::employees.email') }}</th>
                        <td>{{ $employee->email }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('users::employees.job_role_id') }}</th>
                        <td>{{ $employee->jobRole->name }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
       

    </div>
    
@endsection