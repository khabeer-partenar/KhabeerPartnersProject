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

            <table id="table-ajax" class="table" data-url="{{ route('system-management.source-recommendation-study.index', [
                        'parent_department_id' => Request::input('parent_department_id'),
                        'main_department_id' => Request::input('main_department_id'),
                    ])
                }}"
                data-fields='[
                    {"data": "parent_name","title":"{{ __('systemmanagement::sourceRecommendationStudy.parentName') }}","searchable":"false"},
                    {"data": "name","title":"{{ __('systemmanagement::sourceRecommendationStudy.name') }}","searchable":"false"},
                    {"data": "department_case","title":"{{ __('systemmanagement::sourceRecommendationStudy.department_case') }}","searchable":"false"},
                    {"data": "action","name":"actions","searchable":"false", "orderable":"false"}
                ]'
            >
            </table>

        </div>
       

    </div>
@endsection

@section('scripts_2')
    @include('systemmanagement::shared.scripts')
@endsection