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
            <table class="table">
                <thead>
                    <tr role="row">
                        <th></th>
                        <th> تاريخ الدخول</th>
                        <th> صفة الدخول</th>
                        <th> الاسم ثلاثي  </th>
                        <th> رقم الهوية / الاقامة</th>
                        <th> الجنسية</th>
                        <th>الديانة</th>
                        <th>اجتماع المستشار</th>
                        <th>مكان الاجتماع</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lists as $list)
                        <tr>
                            <td></td>
                            <td>{{ $list->entry_time->format('d/m/Y') }}</td>
                            
                            <td>
                                {{ $list->job }}
                            </td>
                            <td>{{ $list->name }}</td>
                            <td>{{ $list->national_id }}</td>
                            <td>{{ $list->religion->name }}</td>
                            <td>{{ $list->nationality }}</td>
                            <td>
                                    {{ $list->advisor->name }}
                            </td>
                            <td>
                                    {{ $list->room->name }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $lists->links() }} 

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
