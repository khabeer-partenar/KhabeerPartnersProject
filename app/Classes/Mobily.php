<?php

namespace App\Classes;
use GuzzleHttp\Client;


class Mobily
{

    public static function formatNumber($number)
    {
        if (!preg_match('/^(9665[0-9]{8})/', $number)) {
            $number = '966' . preg_replace('/^(00966|\+966|966|0966|0)/', '', trim($number));
        }
        return $number;
    }

    public static function sendMessage($message, $number)
    {
        $url = 'http://api.yamamah.com/SendSMSV3';
        $fields = array(
            "Username" => env(env('APP_ENV').'_YAMAMAH_USERNAME'),
            "Password" => env(env('APP_ENV').'_YAMAMAH_PASSWORD'),
            "Tagname"=> env(env('APP_ENV').'_YAMAMAH_TAGNAME'),
            "Code" => env(env('APP_ENV').'_YAMAMAH_CODE'),
            "Message" => $message,
            "RecepientNumber" => $number,
            "ReplacementList" =>"",
            "SendDateTime" => "0",
            "EnableDR" =>False,
            "VariableList"=>"0"
        );

        $fields_string=json_encode($fields);



        //open connection
        $ch = curl_init($url);
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => $fields_string
        ));


        //execute post
        $result = curl_exec($ch);
        echo $result;
        //close connection
        curl_close($ch);
    }
}
