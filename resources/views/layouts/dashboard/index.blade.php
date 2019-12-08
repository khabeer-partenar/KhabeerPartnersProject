<!DOCTYPE html>
    <html lang="{{ app()->getLocale() }}" dir="rtl">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="/assets/images/favicon.ico" />

        {{--CSRF Token--}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{--Title--}}
        <title>{{ __('messages.title') }} @yield('title')</title>

        {{--Common App Styles--}}
        @include('layouts.dashboard.css')

        {{--Head--}}
        @yield('head')

    </head>

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">

        <div id="vue-app">
            @include('layouts.dashboard.top-menu')
            @include('layouts.dashboard.main_wrapper')
            @include('layouts.dashboard.footer')
        </div>
        
        @include('layouts.dashboard.js')
    </body>

</html>
