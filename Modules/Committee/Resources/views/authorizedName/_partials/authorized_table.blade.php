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