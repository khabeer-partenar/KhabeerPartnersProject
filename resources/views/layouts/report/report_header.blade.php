<link rel="stylesheet" type="text/css" href="assets/css/dashboard_layout.css">

<style>
    body {
        font-size: 1.3em ;
    }
</style>
<div style="width: 100%; height: 15%" >
    <table>

        <tr>
            <td width="70%">
                <img style="float: right;width: 70%;" class="text-center"
                     src="{{$_SERVER['DOCUMENT_ROOT'] .'/assets/images/logo.png'}}">
            </td>
            <td width="300px">
                <label >رقم الطلب : {{  $committee->uuid}}</label>
                <br><br>
                <label >تاريخ الطلب : {{  $committee->created_at_hijri}}</label>
            </td>
        </tr>
    </table>
</div>