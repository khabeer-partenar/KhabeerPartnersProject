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

            <table id="table-ajax" class="table" data-url="{{ route('employees.index', [
                    'employee_id' => Request::input('employee_id'),
                    'job_role_id' => Request::input('job_role_id'),
                    'direct_department' => Request::input('direct_department')])
                }}"
                data-fields='[
                    {"data": "name","title":"{{ __('messages.name') }}","searchable":"false"},
                    {"data": "deptname","title":"{{ __('messages.deptname') }}","searchable":"false"},
                    {"data": "contact_options","title":"{{ __('users::employees.contact_options') }}","searchable":"false"},
                    {"data": "job_role","title":"{{ __('users::employees.job_role_id') }}","searchable":"false"},
                    {"data": "action","name":"actions","searchable":"false", "orderable":"false"}
                ]'
            >
            </table>

            <!-- <table cellpadding="3" cellspacing="1" border="0" class="PagerContainerTable">
                <tbody>
                    <tr>
                        <td class="PagerInfoCell">
                            <span>صفحة 1 من 2</span>
                        </td>
                        <td class="PagerCurrentPageCell">
                            <span class="PagerHyperlinkStyle"><strong>1</strong></span>
                        </td>
                        <td class="PagerOtherPageCells">
                            <a class="PagerHyperlinkStyle" href="#" title="عرض النتائج 11 إلى 14 من 14"><span>2</span></a>
                        </td>
                       <td class="PagerOtherPageCells">
                           <a class="PagerHyperlinkStyle" href="#" title=" الصفحة التالية 2"> <span>التالية</span></a>
                        </td>
                    </tr>
                </tbody>
            </table> -->

        </div>
       

    </div>
@endsection