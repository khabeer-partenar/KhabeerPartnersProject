@extends('layouts.dashboard.index')

@section('page')
    <div class="portlet light bordered">

        <div class="portlet-title">
            <div class="row">
                
                <div class="col-md-9">
                    <div class="caption">
                        <i class="fa fa-users"></i>
                        <span class="caption-subject sbold">{{ __('committee::committees.authorizedNames') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="portlet-body">
            @include('committee::authorizedName.search')
            <br>
        </div>
        <div class="portlet-body">
            @include('committee::authorizedName._partials.authorized_table', compact('authorizedNames'))
        </div>
    </div>
    <br>

    <div class="portlet light bordered">
        <a class="btn btn-warning" href="{{ route('committee.export', \Request::all()) }}">تصدير ملف اكسيل</a>
        <a class="btn btn-success" href="{{ route('committee.print', \Request::all()) }}">طباعة</a>
    </div>
    
@endsection

@section('scripts_2')
    @include('committee::committees.scripts')
@endsection
