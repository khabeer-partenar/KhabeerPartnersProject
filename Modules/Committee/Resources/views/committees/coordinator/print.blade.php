<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="rtl">
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.3/css/bootstrap.min.css" integrity="sha384-MIwDKRSSImVFAZCVLtU0LMDdON6KVCrZHyVQQj6e8wIEJkW4tvwqXrbMIya1vriY" crossorigin="anonymous">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{--  @include('layouts.report.authorized_list_report')  --}}
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
         <center><label> تقرير حالة الحضور</label></center>
        <br>
        <br><br>
    
        <table style="width: 100%" class="table table-bordered">
                <thead>
                <tr style="font-weight:bold">
                    <th style="width:7%" scope="col">
                        
                    </th>
                    <th scope="col">نوع الإجتماع
                        <br> تاريخ الإجتماع
                    </th>
                    <th scope="col">حالة الدعوة</th>
                    <th scope="col">حالة الحضور</th>
                    <th scope="col">اسم المندوب</th>
                    <th scope="col">الجهة</th>
                    <th scope="col">سبب الإعتذار</th>
                </tr>
                </thead>
                <tbody id="delegatesDiv" class="containerUnCheckAll" data-checker="#checkAllDelegates">
            
                @foreach($committee->meetings as $meeting)
                    @foreach($meeting->delegates as $delegate)
                        <tr>
                            <td>
                                
                            </td>
                            <td>
                                {{ $meeting->type->name }}
                                <br>
                                {{ $meeting->meeting_at }}
                            </td>
                            <td>
                                {{ __('committee::meetings.' . \Modules\Committee\Entities\MeetingDelegate::STATUS[$delegate->pivot->status]) }}
                            </td>
                            <td>
                                @if (is_null($delegate->pivot->attended))
                                    {{ '-' }}
                                @else
                                    {{ $delegate->pivot->attended ? __('committee::meetings.attended'):__('committee::meetings.absent') }}
                                @endif
                            </td>
                            <td>
                                <span title="{{ $delegate->phone_number }}">{{ $delegate->name }}</span>
                            </td>
                            <td>{{ $delegate->department->name }}</td>
                            <td>
                                {{ $delegate->pivot->status == \Modules\Committee\Entities\MeetingDelegate::REJECTED ? $delegate->pivot->refuse_reason:'' }}
                            </td>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
        <br><br>
    </div>
    </div>
</html>



