<!DOCTYPE html>
    <html lang="{{ app()->getLocale() }}" dir="rtl">
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('page_title')</title>

        {{--CSRF Token--}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{--Common App Styles--}}
         @include('layouts.auth.css')

        {{--Head--}}
        @yield('head')
    </head>


    <body class="login">

        {{--Page--}}
        @yield('page')

        @include('layouts.auth.js')
    </body>
</html>