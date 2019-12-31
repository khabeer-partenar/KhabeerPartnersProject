@extends('layouts.dashboard.index')

@section('page')

    <div class="portlet light bordered">

        <div class="portlet-title">
            <div class="row">
                <div class="col-md-9">
                    <div class="caption">
                        <i class="fa fa-eye"></i>
                        <span class="caption-subject sbold">{{ __('users::delegates.information') }}</span>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="actions item-fl item-mb20">
                        @if(auth()->user()->hasPermissionWithAccess('edit'))
                            <a href="{{ route('delegates.edit', $delegate) }}" class="btn btn-sm btn-warning">
                                <i class="fa fa-edit"></i> {{ __('users::delegates.edit') }}
                            </a>
                        @endif
                    </div>
                </div>
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
                    <td>{{ $delegate->mainDepartment->name }}</td>
                </tr>
                <tr>
                    <th scope="row">اسم الجهة</th>
                    <td>
                        {{ $delegate->parentDepartment->name }}
                        <span style="color: #aeaeae;font-style: italic;">{{ $delegate->parentDepartment->is_reference ? '- جهة مرجعية':'' }}</span>
                    </td>
                </tr>
                <tr>
                    <th scope="row">مرجعية الجهة</th>
                    <td>{{ $delegate->departmentReference ? $delegate->departmentReference->name:'-' }}</td>
                </tr>
                <tr>
                    <th scope="row">المسمي الوظيفي</th>
                    <td>{{ $delegate->job_title }}</td>
                </tr>
                <tr>
                    <th scope="row">الاختصاص</th>
                    <td>{{ $delegate->specialty }}</td>
                </tr>
                <tr>
                    <th scope="row">الإدارة</th>
                    <td>{{ $delegate->direct_department ? $delegate->direct_department:'-' }}</td>
                </tr>
                <tr>
                    <th scope="row">اللقب</th>
                    <td>{{ $delegate->title }}</td>
                </tr>
                <tr>
                    <th scope="row">رقم الهوية</th>
                    <td>{{ $delegate->national_id }}</td>
                </tr>
                <tr>
                    <th scope="row">الاسم</th>
                    <td>{{ $delegate->name }}</td>
                </tr>
                <tr>
                    <th scope="row">رقم الجوال</th>
                    <td>{{ $delegate->phone_number }}</td>
                </tr>
                <tr>
                    <th scope="row">البريد الإلكتروني</th>
                    <td>{{ $delegate->email }}</td>
                </tr>
                <tr>
                    <th scope="row">الدور التوظيفي</th>
                    <td>{{ $delegate->jobRole->name }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection