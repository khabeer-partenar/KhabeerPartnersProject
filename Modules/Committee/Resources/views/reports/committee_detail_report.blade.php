<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('layouts.report.report_header')

    {{--    <img src="https://www.google.pl/images/srpr/logo11w.png"/>--}}
</head>
<div class="portlet light bordered report">
        <div class="portlet-title">

            <div class="row">
                <p style="text-align:center">(رسالة إلكترونية)</p>
                <h3 style="text-align:center; color:red">{{ $committee->treatmentImportance->name }}  -  {{ $committee->treatmentUrgency->name }}</h3>

            </div>

        </div>

    <div class="portlet-body">

        <strong >الجهه المرسل إليها: {{auth()->user()->parentDepartment->name}}</strong>

        <p><strong>الموضوع:</strong> {{$committee->subject}}</p>

        <label><strong>موعد الاجتماع:</strong> يوم {{__('messages.'.$committee->first_meeting_at->format('D'))}}
            تاريخ {{ \App\Classes\Date\CarbonHijri::parse($committee->first_meeting_at_hijri)->format('d-m-Y') }} هـ الساعة  {{$committee->first_meeting_time}}</label>

        @if($meeting && $meeting->room)
            <p><strong>مقر الاجتماع:</strong>
                هيئة الخبراء بمجلس الوزراء
                {{ 'ب' . $meeting->room->name }} - {{ $meeting->room->city->name }}
            </p>
        @endif

        <p><strong>المستشار المسئول:</strong> {{$committee->advisor->name}}</p>

        <strong> الجهات المشاركة فى الدراسة:</strong>
        <br>
        <table class="table table-striped table-responsive-md">

            <tbody>
            @foreach($committee->participantDepartments as $department)
                <tr>
                    <td>{{ $loop->index + 1 }}-</td>
                    <td>
                        {{ $department->name }}
                    </td>
                    <br>
                </tr>
            @endforeach
            </tbody>
        </table>
        <p style="line-height: 1.7;">
            &nbsp;&nbsp;&nbsp;
            نأمل توجيه من ترون وتكليفه للمشاركة في الاجتماع، وترشيحه عن طريق منصة (شركاء خبير) خلال موعد أقصاه (قبل 48 ساعة من موعد الاجتماع)، مع التقيد بما قضى به الأمر السامي التعميمي رقم (17134) وتاريخ 26/3/1441ه.
        </p>

    </div>
</div>
</html>



