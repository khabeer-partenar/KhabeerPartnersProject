<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
        <table class="table">
            <thead>
                <tr>
                    <th  width="100"  style="font-size:18px">معلومات المشارك</th>
                    <th  width="100" style="font-size:18px">مرئيات الإجتماع</th>
                </tr>
            </thead>
            <tbody>
            @foreach($delegates as $delegate)
                @foreach($delegate->multimedia as $multimedia) 

                <tr width="100">
                    <td align="center" valign="bottom"  style="font-size:13px"><b><h2>{{ $delegate->name . ' - ' . $delegate->department->name }}</h2></b></td>
                    <td align="center" valign="bottom" style="font-size:13px">{{ $multimedia->text }}</td>
                     
                </tr>
                @endforeach 

            @endforeach
            </tbody>
        </table>
</body>
</html>        
<tr>
          
