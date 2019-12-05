<link rel="stylesheet" type="text/css" href="{{$_SERVER['DOCUMENT_ROOT'] .'/assets/css/main_report.css'}}">
<link rel="stylesheet" type="text/css" href="{{$_SERVER['DOCUMENT_ROOT'] .'/assets/css/global.css'}}">
<div style="width: 100%; height: 20%" >
    <table>

        <tr>
            <td width="70%">
                <img style="float: right" class="text-center"
                     src="{{$_SERVER['DOCUMENT_ROOT'] .'/assets/images/logo.png'}}">
            </td>
            <td width="300px">
                <label >رقم الطلب : {{  $committee->uuid}}</label>
                <br>
                <label >تاريخ الطلب : {{  $committee->created_at_hijri}}</label>
            </td>
        </tr>
    </table>
</div>