<?php
/**
 * @author Mamdouh Magdy <mamdouh95@mu.edu.sa>
 */
return [
    /*
    |--------------------------------------------------------------------------
    | Mobile Number you are using to send SMS
    |--------------------------------------------------------------------------
    */
    'mobile' => env('MOBILY_NUMBER'),

    /*
    |--------------------------------------------------------------------------
    | Password Used to send SMS
    |--------------------------------------------------------------------------
    */
    'password' => env('MOBILY_PASSWORD'),

    'sender' => urldecode(env('MOBILY_SENDER')),

    'lang' => env('MOBILY_LANG', 3),

    'application-type' => (int) env('MOBILY_APP_TYPE', 68)
];