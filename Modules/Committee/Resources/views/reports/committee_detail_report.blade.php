<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('layouts.report.report_header')

    {{--    <img src="https://www.google.pl/images/srpr/logo11w.png"/>--}}

</head>
<div class="portlet light bordered">


    <div class="portlet-body form">
        <label>الجهه المرسل إليها : {{auth()->user()->parentDepartment->name}}</label>

        <p>
            الموضوع : طلب تسمية مندوب للاجتماع مع المستشار {{ $committee->advisor->name }} لدراسة المعاملة
            رقم {{$committee->treatment_number }}
            الواردة من الأمانة العامة لمجلس الوزراء
        </p>
        <br>
        <label>موعد الاجتماع يوم {{__('messages.'.$committee->first_meeting_at->format('D'))}}
            تاريخ {{ $committee->first_meeting_at_hijri }} هـ </label>
        <br><br>
        <label>مقر الاجتماع : هيئة الخبراء بمجلس الوزراء بقصر اليمامة</label>

        <br><br>
        <label> الجهات المشاركة فى الدراسة</label>
        <br>
        <table class="table table-striped table-responsive-md">

            <tbody>
            @foreach($committee->participantDepartments as $department)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>
                        {{ $department->name }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <br><br>
        <label> المطلوب : توجيه من ترون للمشاركة فى الاجتماع وترشيحه عن طريق منصة شركاء خبير خلال موعد أقصاه (قبل 24
            ساعة من موعد الإجتماع) ولمزيد المعلومات عن الموضوع أمل الرجوع للمنصة عبر الرابط kp.boe.gov.sa</label>


    </div>
</div>
</html>



