<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{--CSRF Token--}}

    {{--Title--}}
    <title>{{ __('messages.title') }} @yield('title')</title>

    {{--Common App Styles--}}
    @include('layouts.report.css')
    @include('layouts.report.report_header')

</head>

<body style="font-family: 'Droid Arabic Kufi', serif;" dir="rtl">
@yield('page')

</body>
@include('layouts.report.report_footer')

</html>
