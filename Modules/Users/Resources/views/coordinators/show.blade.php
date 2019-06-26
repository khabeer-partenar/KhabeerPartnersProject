@extends('layouts.dashboard.index')

@section('page')

    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="caption">
                <i class="fa fa-eye"></i>
                <span class="caption-subject sbold">{{ __('users::coordinators.information') }}</span>
            </div>
            
            <div class="actions">
                <a href="{{ route('coordinators.edit', $coordinator) }}" class="btn blue"><i class="fa fa-edit"></i> {{ __('users::coordinators.edit') }}</a>
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
                        <th scope="row">نوع الجهة</th>
                        <td>{{ $coordinator->mainDepartment->name }}</td>
                    </tr>
                    <tr>
                        <th scope="row">اسم الجهة</th>
                        <td>{{ $coordinator->parentDepartment->name }}</td>
                    </tr>
                    <tr>
                        <th scope="row">مرجعية الجهة</th>
                        <td>{{ $coordinator->department_reference }}</td>
                    </tr>
                    <tr>
                        <th scope="row">المسمي الوظيفي</th>
                        <td>{{ $coordinator->job_title }}</td>
                    </tr>
                    <tr>
                        <th scope="row">الإدارة</th>
                        <td>{{ $coordinator->directDepartment->name }}</td>
                    </tr>
                    <tr>
                        <th scope="row">اللقب</th>
                        <td>{{ $coordinator->title }}</td>
                    </tr>
                    <tr>
                        <th scope="row">رقم الهوية</th>
                        <td>{{ $coordinator->national_id }}</td>
                    </tr>
                    <tr>
                        <th scope="row">الاسم</th>
                        <td>{{ $coordinator->name }}</td>
                    </tr>
                    <tr>
                        <th scope="row">رقم الجوال</th>
                        <td>{{ $coordinator->phone_number }}</td>
                    </tr>
                    <tr>
                        <th scope="row">البريد الإلكتروني</th>
                        <td>{{ $coordinator->email }}</td>
                    </tr>
                    <tr>
                        <th scope="row">الدور التوظيفي</th>
                        <td>{{ $coordinator->jobRole->name }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection