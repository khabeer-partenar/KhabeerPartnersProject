
@if (isset($delegates))
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="rtl">
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.3/css/bootstrap.min.css" integrity="sha384-MIwDKRSSImVFAZCVLtU0LMDdON6KVCrZHyVQQj6e8wIEJkW4tvwqXrbMIya1vriY" crossorigin="anonymous">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <body>
        <div class="portlet light bordered" id="source-html">
            <div class="portlet-body form">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="table " class="table table-bordered table-responsive" width="100%">
                            <thead>
                            <tr style="font-weight:bold">
                                <th scope="col"> الادارة</th>
                                <th scope="col">مرئيات الإجتماع</th>
                                <th scope="col">معلومات المشارك</th>
                            </tr>
                            </thead>
                            <tbody id="multimediaDiv" class="containerUnCheckAll" data-checker="#checkAllMultimedia">
                            @foreach($delegates as $delegate)
                                <tr>
                                    <td scope="col"><center>{{ $delegate->department->name }}</center>
                                    </td>
                                    <td scope="col" class="align-center"><center>
                                        @foreach($delegate->multimedia as $multimedia)
                                            <div class="col-md-12" >
                                                <textarea class="form-control" style="width: 100%"
                                                        disabled >{{ $multimedia->text }}</textarea>
                                                <p > {{__('committee::delegate_meeting.multimedia_date') . ' : ' . $multimedia->updated_at}}</p>
                                                <hr style="margin-top: 5px;margin-bottom: 5px">
                                            </div>
                                        @endforeach</center>
                                    </td>
                                    <td scope="col" class="align-center"><center>{{ $delegate->name }}</center></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        @include('layouts.dashboard.js')
    </body>
</html>
@endif


