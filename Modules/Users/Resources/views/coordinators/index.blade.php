@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="caption">
                <i class="fa fa-users"></i>
                <span class="caption-subject sbold">{{ __('users::coordinators.manage') }}</span>
            </div>
            
            <div class="actions">
                <a href="{{ route('coordinators.create') }}" class="btn btn-primary">{{ __('users::coordinators.action_add') }}</a>
            </div>
        
        </div>

        <div class="portlet-body">
            {{-- Search Form --}}
            <form class="form-inline" method="get" id="search-coordinators" action="{{ route('coordinators.index') }}">
                <div class="form-group">
                    <label for="department_type">نوع الجهة</label>
                    <select name="main_department_id" id="main_department_id" class="form-control select2 load-departments"
                            data-url="{{ route('departments.children') }}" data-child="#parent_department_id">
                        <option value="0">{{ __('users::departments.choose a department') }}</option>
                        @foreach($mainDepartments as $key => $department)
                            <option value="{{ $key }}" {{ Request::input('main_department_id') == $key ? 'selected':'' }}>{{ $department }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="department_name">اسم الجهة</label>
                    <select name="parent_department_id" id="parent_department_id" class="form-control select2 load-departments"
                            data-url="{{ route('departments.children') }}" data-child="#direct_department_id">
                        <option value="0">{{ __('users::departments.choose a department') }}</option>
                        @php $parentDepartment = Request::input('parent_department_id') @endphp
                        @foreach(\Modules\Users\Entities\Department::getParentDepartments(Request::input('main_department_id')) as $key => $department)
                            <option value="{{ $key }}" {{ $parentDepartment == $key ? 'selected':'' }}>{{ $department }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">اسم المنسق</label>
                    <input type="text" class="form-control" value="{{ Request::input('name') }}" name="name" id="name" placeholder="">
                </div>
                <button type="submit" class="btn btn-default search-table" data-form="#search-coordinators">بحث</button>
            </form>
            {{-- DataTable --}}
            <table id="table-ajax" class="table" data-url="{{ route('coordinators.index', [
                'name' => Request::input('name'),
                'main_department_id' => Request::input('main_department_id'),
                'parent_department_id' => Request::input('parent_department_id')])
             }}"
                data-fields='[
                    {"data": "id","title":"ID","searchable":"true"},
                    {"data": "name","title":"{{ __('messages.name') }}","searchable":"true"},
                    {"data": "email","title":"{{ __('messages.email') }}","searchable":"true"},
                    {"data": "national_id","title":"{{ __('messages.national_id') }}","searchable":"true"},
                    {"data": "phone_number","title":"{{ __('messages.phone_number') }}","searchable":"true"},
                    {"data": "action","name":"actions","searchable":"false", "orderable":"false"}
                ]'
            >
            </table>
        </div>

    </div>
@endsection

@section('scripts_2')
    @include('users::coordinators.scripts')
@endsection
