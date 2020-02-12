<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="rtl">
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.3/css/bootstrap.min.css" integrity="sha384-MIwDKRSSImVFAZCVLtU0LMDdON6KVCrZHyVQQj6e8wIEJkW4tvwqXrbMIya1vriY" crossorigin="anonymous">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @include('layouts.report.authorized_list_report')
        {{--    <img src="https://www.google.pl/images/srpr/logo11w.png"/>--}}
        <style type="text/css">
            .table-striped tbody tr:nth-of-type(odd) {
                padding: 90px;
                border: 1px solid black;

                border-collapse: collapse;

                background-color: rgba(0,0,0,.015);
            }
            .table tbody td {
                border-collapse: collapse;

                border: 1px solid black;
                border-bottom: 1px solid #ff5722;
                font-size: 16px;
            }

            .table thead th {
                border: 1px solid black;

                border-bottom: 1px solid #ff5722;
            }

            .text-warning {
                color: #ff5722 !important;
            }

            .tag {
                padding: 1em 1em;
            }
        </style>
    </head>
    <div class="portlet light bordered">
    <br>
    <br>
    <br>
    <div class=" form">
        <label>اسماء المصرح لهم بالدخول</label>
        <br>
        <br><br>
        <br>
        <br>
        <table id="table " class="table table-bordered table-responsive">
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
                    @if($authorized->driver_id)
                        <tr>
                            <td></td>
                            <td>
                                {{ date('m-d-Y H:i:s', strtotime($authorized->from)) }}<br>
                            </td>
                            <td>{{ $authorized->job_title }}</td>
                            <td>{{ $authorized->delegate_name }}</td>
                            <td>{{ $authorized->delegate_national_id }}</td>
                            <td> السعودية</td>
                            <td>مسلم</td>
                            <td> {{ $meeting[0]->advisor->name }}</td>
                            <td> {{ $meeting[0]->room->name }}</td>
                        </tr>
                     @endif
                        <tr>
                            <td></td>
                            <td>{{ date('m-d-Y H:i:s', strtotime($authorized->from)) }}</td>
                            <td>سائق</td>
                            <td>{{ $authorized->driver_name }}</td>
                            <td>{{ $authorized->driver_national_id }}</td>
                            <td> {{ $authorized->nationality }}</td>
                            <td> {{ $authorized->type }}</td>
                            <td> {{ $meeting[0]->advisor->name }}</td>
                            <td> {{ $meeting[0]->room->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
        </table>
        <br><br>
    </div>
    </div>
</html>



