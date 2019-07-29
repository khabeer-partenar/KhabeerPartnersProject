<?php

namespace App\Classes;

class Mobily
{
    public static function send($sendToNumber, $msg)
    {
        $post = [
            'mobile' => config('mobily.mobile'),
            'password' => config('mobily.password'),
            'sender' => config('mobily.sender'),
            'msg' => $msg,
            'lang' => config('mobily.lang'),
            'applicationType' => config('mobily.application-type'),
            'numbers' => $sendToNumber,
            'timeSend' => 0,
            'dateSend' => 0,
        ];
        $ch = curl_init('http://www.mobily.ws/api/msgSend.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        // execute!
        $response = curl_exec($ch);
        // close the connection, release resources used
        curl_close($ch);
        // do anything you want with your response
        return $response;
    }
}