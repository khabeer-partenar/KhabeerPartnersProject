<!doctype html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>طلب تسمية</title>
</head>
<style>
    .email-container {
        align-content: center;
        text-align: center;
    }
    hr {
        border-width: 0.5px;
    }
    .btn {
        display: inline-block;
        margin-bottom: 0;
        font-weight: 400;
        text-align: center;
        vertical-align: middle;
        touch-action: manipulation;
        cursor: pointer;
        border: 1px solid transparent;
        white-space: nowrap;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857;
        border-radius: 4px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
    .btn-green {
        background-color: green;
        color: white;
    }
    .no-decoration {
        text-decoration: none;
    }
    .body {
        padding: 10px;
    }
</style>
<body>
<div class="email-container">
    <img src="{{ asset('/assets/images/logo.png') }}">
    <hr>
    <div class="body">
        @yield('content')
    </div>
    <hr>
    <footer>
        جميع الحقوق محفوظة لهيئة الخبراء بمجلس الوزاراء
    </footer>
</div>
</body>
</html>