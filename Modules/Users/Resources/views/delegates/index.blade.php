@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="row">

                <div class="col-md-9">
                    <div class="caption">
                        <i class="fa fa-users"></i>
                        <span class="caption-subject sbold">{{ __('users::delegates.manage2') }}</span>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="actions item-fl item-mb20">
                        @if(auth()->user()->hasPermissionWithAccess('create'))
                            <a href="{{ route('delegates.create') }}" class="btn btn-primary">{{ __('users::delegates.action_add') }}</a>
                        @endif
                    </div>
                </div>

            </div>
        
        </div>

        <div class="portlet-body">

            {{-- Search Form --}}
            <div class="row">
                <form class="" method="get" id="search-delegates" action="{{ route('delegates.index') }}">
                    {{--form-inline--}}
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label" for="department_type">نوع الجهة</label>
                            <select name="main_department_id" id="main_department_id" class="form_control select2 load-departments"
                                    data-url="{{ route('system-management.departments.children') }}" data-child="#parent_department_id">
                                <option value="0">{{ __('users::departments.choose a department') }}</option>
                                @foreach($mainDepartments as $key => $department)
                                    <option value="{{ $key }}" {{ Request::input('main_department_id') == $key ? 'selected':'' }}>{{ $department }}</option>
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
                                @php $parentDepartment = Request::input('parent_department_id') @endphp
                                @foreach(\Modules\SystemManagement\Entities\Department::getParentDepartments(Request::input('main_department_id')) as $key => $department)
                                    <option value="{{ $key }}" {{ $parentDepartment == $key ? 'selected':'' }}>{{ $department }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name" class="control-label">اسم المندوب</label>
                            <input type="text" class="form_control" value="{{ Request::input('name') }}" name="name" id="name" placeholder="">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary_s search-table" data-form="#search-delegates">بحث</button>
                    </div>


                </form>
            </div>

            {{-- DataTable --}}
            <table id="table-ajax" class="table" data-url="{{ route('delegates.index', [
                'name' => Request::input('name'),
                'main_department_id' => Request::input('main_department_id'),
                'parent_department_id' => Request::input('parent_department_id')
                ])
             }}"
                data-fields='[
                    {"data": "name","title":"{{ __('messages.name') }}","searchable":"true"},
                    {"data": "department_info","name":"actions","title":"{{ __('messages.department_info') }}","searchable":"false", "orderable":"false"},
                    {"data": "contact_options","name":"actions","title":"{{ __('messages.contact_options') }}","searchable":"false", "orderable":"false"},
                    {"data": "action","name":"actions","searchable":"false", "orderable":"false"}
                ]'
            >
            </table>
        </div>

    </div>
@endsection

{{--@section('scripts_2')
    @include('users::delegates.scripts')
@endsection--}}
