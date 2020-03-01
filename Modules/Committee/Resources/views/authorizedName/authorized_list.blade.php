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
                    @foreach($authorizedNames as $authorized)
                        @php !isset($authorized->user_type) ? $authorized->user_type = 'all':'' @endphp
                        @if (Request::input('job_title') != 'driver' && $authorized->user_type != 'driver')
                            <tr>
                                <td></td>
                                <td>
                                    {{ date('m-d-Y H:i:s', strtotime($authorized->from)) }}<br>
                                </td>
                                <td>مندوب</td>
                                <td>{{ $authorized->delegate_name }}</td>
                                <td>{{ $authorized->delegate_national_id }}</td>
                                <td> {{ $authorized->delegate_nationality_name }}</td>
                                <td>مسلم</td>
                                <td> {{ $authorized->advisor_name }}</td>
                                <td> {{ $authorized->room_name }}</td>
                            </tr>
                        @endif
                        @if($authorized->has_driver && Request::input('job_title') != 'delegate' && $authorized->user_type != 'delegate')
                            <tr>
                                <td></td>
                                <td>{{ date('m-d-Y H:i:s', strtotime($authorized->from)) }}</td>
                                <td>سائق</td>
                                <td>{{ $authorized->driver_name }}</td>
                                <td>{{ $authorized->driver_national_id }}</td>
                                <td> {{ @$authorized->driver_nationality_name }}</td>
                                <td> {{ $authorized->type }}</td>
                                <td> {{ $authorized->advisor_name }}</td>
                                <td> {{ $authorized->room_name }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    <br>

    <div class="portlet light bordered">
        <a class="btn btn-warning" href="{{ route('committee.export', \Request::all()) }}">تصدير ملف اكسيل</a>
        <a class="btn btn-success" href="{{ route('committee.print', \Request::all()) }}">طباعة</a>
    </div>   

{{--    {{ $authorizedNames->links() }} --}}
    
    
@endsection

@section('scripts_2')
    @include('committee::committees.scripts')
@endsection
