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
    @include('layouts.dashboard.css')
    @include('layouts.report_header')

</head>

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
@yield('page')

</body>
@include('layouts.report_footer')

</html>
