@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="row">
                <div class="col-md-9">
                    <div class="caption">
                        <i class="fa fa-bars"></i>
                        <span class="caption-subject sbold">{{ __('systemmanagement::sourceRecommendationStudy.title') }}</span>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="actions">
                    </div>
                </div>
            </div>
            
        </div>

        <div class="portlet-body">
            
            @include('systemmanagement::sourceRecommendationStudy.search')

            <div class="table-responsive">
                <table class="table">
                    <thead>

                        <tr role="row">
                            <th>{{ __('systemmanagement::sourceRecommendationStudy.parentName') }}</th>
                            <th>{{ __('systemmanagement::sourceRecommendationStudy.name') }}</th>
                            <th>{{ __('systemmanagement::sourceRecommendationStudy.department_case') }}</th>
                            <th></th>
                        </tr>

                    </thead>
                    <tbody>
                        
                        @foreach($departmentsData as $key => $departmentData)
                            <tr>
                                <td>{{ @$departmentData->name }}</td>
                                <td>{{ @$departmentData->parent->name }}</td>
                                <td>
                                    @if($departmentData->shown_in_committee_recommended)
                                        <span class="badge badge-info badge-roundless">الجهة الموصية بالدراسة</span>
                                    @endif

                                    @if($departmentData->shown_in_committee_recommended && $departmentData->shown_in_committee_source_of_study)
                                        <br>
                                    @endif
                                    
                                    @if($departmentData->shown_in_committee_source_of_study)
                                        <span class="badge badge-info badge-roundless">الجهة مصدر الدراسة</span>
                                    @endif
                                </td>
                                <td>
                                    @if(auth()->user()->hasPermissionWithAccess('edit'))
                                        <a href="{{ route('system-management.source-recommendation-study.edit', $departmentData) }}" class="btn btn-sm btn-warning custom-action-btn">
                                            <i class="fa fa-edit"></i> {{ __('systemmanagement::systemmanagement.edit_btn') }}
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                        @if($departmentsData->count() == 0)
                            <tr>
                                <td colspan="4"><center>لا يوجد بيانات</center></td>
                            </tr>
                        @endif

                    
                    </tbody>
                </table>
            </div>

            {{ $departmentsData->links() }}

        </div>
       

    </div>
@endsection

@section('scripts_2')
    @include('systemmanagement::shared.scripts')
@endsection