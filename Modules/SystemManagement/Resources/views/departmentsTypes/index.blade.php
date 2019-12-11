@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="row">
                <div class="col-md-9">
                    <div class="caption">
                        <i class="fa fa-bars"></i>
                        <span class="caption-subject sbold">{{ __('systemmanagement::systemmanagement.departmentsTypes') }}</span>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="actions" style="float:left;">
                        @if(auth()->user()->hasPermissionWithAccess('departmentsTypesCreate'))
                            <a href="{{ route('system-management.departments-types.create') }}" class="btn btn-primary">{{ __('messages.add') }}</a>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        <div class="portlet-body">
            
            @include('systemmanagement::departmentsTypes.search')

            <table id="table-ajax" class="table" data-url="{{ route('system-management.departments-types.index', [
                        'department_id' => Request::input('department_id')
                    ])
                }}"
                data-fields='[
                    {"data": "name","title":"{{ __('systemmanagement::systemmanagement.departmentTypeName') }}","searchable":"false"},
                    {"data": "action","name":"actions","searchable":"false", "orderable":"false"}
                ]'
            >
            </table>

            <!-- <table cellpadding="3" cellspacing="1" border="0" class="PagerContainerTable">
                <tbody>
                    <tr>
                        <td class="PagerInfoCell"><span>صفحة 1 من 2</span></td>
                        <td class="PagerCurrentPageCell"><span class="PagerHyperlinkStyle" title="عرض النتائج 1 إلى 10 من 14"><strong> 1 </strong></span></td>
                        <td class="PagerOtherPageCells"><a class="PagerHyperlinkStyle" href="http://norportal.sure.com.sa/Elibrary/Eforms/Pages/default.aspx?PageIndex=2" title="عرض النتائج 11 إلى 14 من 14"> <span>2</span> </a></td>
                        <td class="PagerOtherPageCells"><a class="PagerHyperlinkStyle" href="http://norportal.sure.com.sa/Elibrary/Eforms/Pages/default.aspx?PageIndex=2" title=" الصفحة التالية 2"> <span>التالية</span> </a></td>
                    </tr>
                </tbody>
            </table> -->
            
        </div>
       

    </div>
@endsection

@section('scripts_2')
    @include('systemmanagement::shared.scripts')
@endsection