@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="row">

                <div class="col-md-9">
                    <div class="caption">
                        <i class="fa fa-users"></i>
                        <span class="caption-subject sbold">{{ __('users::coordinators.manage') }}</span>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="actions item-fl item-mb20">
                        @if(auth()->user()->hasPermissionWithAccess('create'))
                            <a href="{{ route('coordinators.create') }}" class="btn btn-primary">{{ __('users::coordinators.action_add') }}</a>
                        @endif
                    </div>
                </div>

            </div>
        
        </div>

        <div class="portlet-body">

            {{-- Search Form --}}
            <div class="row">
                <form class="" method="get" id="search-coordinators" action="{{ route('coordinators.index') }}">
                    {{--form-inline--}}
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label" for="department_type">نوع الجهة</label>
                            <select name="main_department_id" id="main_department_id" class="form_control select2 load-departments"
                                    data-url="{{ route('system-management.departments.children') }}" data-child="#parent_department_id">
                                <option value="0">{{ __('users::departments.choose a department') }}</option>
                                @foreach($mainDepartments as $key => $department)
                                    <option value="{{ $key }}">{{ $department }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="parent_department_id" class="control-label">اسم الجهة</label>
                            <select name="parent_department_id" id="parent_department_id" class="form_control select2 load-departments"
                                    data-url="{{ route('system-management.departments.children') }}" data-child="#direct_department_id">
                                <option value="0">{{ __('users::departments.choose a department') }}</option>
                            </select>
                        </div>
                    </div>
                    

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name" class="control-label">اسم المنسق</label>
                            <input type="text" class="form_control" name="name" id="name" placeholder="">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary_s search-table" data-form="#search-coordinators">بحث</button>
                    </div>


                </form>
            </div>

            <table class="table">
                <thead>

                    <tr role="row">
                        <th>{{ __('messages.name') }}</th>
                        <th>{{ __('messages.department_info') }}</th>
                        <th>{{ __('messages.contact_options') }}</th>
                        <th></th>
                    </tr>

                </thead>
                <tbody>
                    
                    @foreach($coordinatorsData as $key => $coordinatorData)
                        <tr>
                            <td>{{ $coordinatorData->name }}</td>
                            <td>
                                {{ $coordinatorData->mainDepartment->name }} - {{ $coordinatorData->parentDepartment->name }}
                            </td>
                            <td>
                                {{ $coordinatorData->phone_number }} <br>
                                {{ $coordinatorData->email }}
                            </td>
                            <td>
                                @if(auth()->user()->hasPermissionWithAccess('show'))
                                    <a href="{{ route('coordinators.show', $coordinatorData) }}" class="btn btn-sm btn-primary custom-action-btn">
                                        <i class="fa fa-eye"></i> {{ __('users::coordinators.show') }}
                                    </a>
                                @endif
                                @if(auth()->user()->hasPermissionWithAccess('destroy'))
                                    <a data-href="{{ route('coordinators.destroy', $coordinatorData) }}" class="btn btn-sm btn-danger delete-row custom-action-btn">
                                        <i class="fa fa-trash"></i> {{ __('users::coordinators.delete') }}
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    @if($coordinatorsData->count() == 0)
                        <tr>
                            <td colspan="5"><center>لا يوجد بيانات</center></td>
                        </tr>
                    @endif

                
                </tbody>
            </table>

            {{ $coordinatorsData->links() }}
        </div>

    </div>
@endsection

@section('scripts_2')
    @include('users::coordinators.scripts')
@endsection
