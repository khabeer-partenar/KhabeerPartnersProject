@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">

            <div class="row">

                <div class="col-md-9">
                    <div class="caption">
                        <i class="fa fa-edit"></i>
                        <span class="caption-subject sbold">{{ __('systemmanagement::sourceRecommendationStudy.edit_title') }}</span>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="actions" style="float:left;">
                        <a href="{{ route('system-management.source-recommendation-study.index') }}" class="btn btn-primary">{{ __('messages.goBack') }}</a>
                    </div>
                </div>
                
        </div>

        <div class="portlet-body form">
            
            {{ Form::model($department, ['route' => ['system-management.source-recommendation-study.update', $department], 'method' => 'put']) }}

                @if($errors->any())
                    <div class="alert alert-danger">{{ __('messages.error_message') }}</div>
                @endif

                <div class="form-body">

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="mt-checkbox-list">
                                    <label class="mt-checkbox mt-checkbox-outline">
                                        {!! Form::checkbox('shown_in_committee_recommended', '1', $department->shown_in_committee_recommended) !!}
                                        إظهار في الجهة الموصية بالدراسة
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="mt-checkbox-list">
                                    <label class="mt-checkbox mt-checkbox-outline">
                                        {!! Form::checkbox('shown_in_committee_source_of_study', '1', $department->shown_in_committee_source_of_study) !!}
                                        إظهار في الجهة مصدر الدراسة
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="form-actions">
                    {{ Form::button(__('messages.save'), ['type' => 'submit', 'class' => 'btn btn-primary item-fl']) }}
                </div>

            {{ Form::close() }}

        </div>


    </div>
@endsection

@section('scripts_2')
    @include('systemmanagement::shared.scripts')
@endsection