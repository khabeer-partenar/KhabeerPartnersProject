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
    /**
     * API URLS
     */
    protected static $sendMessageURL = "http://api.yamamah.com/SendSMSV2";
    protected static $getBalanceURL = "http://oursms.net/api/getbalance.php";


    public static function sendMessage($message, $number)
    {
        $url = 'http://api.yamamah.com/SendSMS';
        $fields = array(
            "Username" => "966500554560",
            "Password" => "19888",
            "Tagname"=>"KP.BOE",
            "Message" => $message,
            "RecepientNumber" => '966596430095',
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

    /**
     * Get SMS balance
     * @return false|string[]
     */
    public static function getBalance()
    {
        $client = new Client();
        $response = $client->request('GET', self::$getBalanceURL, [
                'query' => [
                    'mobile' => env('MOBILY_USER_NAME'),
                    'password' => env('MOBILY_PASSWORD')
                ]
            ]
        );

        return explode('/', trim(strip_tags($response->getBody()->getContents())));
    }

    /**
     * Get SMS current balance
     * @return Integer Sms balance
     */
    public static function getCurrentBalance() {
        $responseArray = self::GetBalance();
        //failure
        if (count($responseArray) == 1 ) {
            return 0;
            //success
        } else {
            return $responseArray[1];
        }
    }

    /**
     * Get message success or fail with message
     * @param String $responseCode returned response code
     */
    public static function getStatusWithMessage($responseCode)
    {
        switch ($responseCode) {
            case "1":
                return ["responseCode" => $responseCode, "success" => true, "message" => app('translator')->get('mobily.sent')];
            case "2":
                return ["responseCode" => $responseCode, "success" => false, "message" => app('translator')->get('mobily.no_charge_zero')];
            case "3":
                return ["responseCode" => $responseCode, "success" => false, "message" => app('translator')->get('mobily.no_charge')];
            case "4":
                return ["responseCode" => $responseCode, "success" => false, "message" => app('translator')->get('mobily.null_user_or_mobile')];
            case "5":
                return ["responseCode" => $responseCode, "success" => false, "message" => app('translator')->get('mobily.wrong_password')];
            case "6":
                return ["responseCode" => $responseCode, "success" => false, "message" => app('translator')->get('mobily.try_later')];
            case "13":
                return ["responseCode" => $responseCode, "success" => false, "message" => app('translator')->get('mobily.sender_not_approval')];
            case "14":
                return ["responseCode" => $responseCode, "success" => false, "message" => app('translator')->get('mobily.empty_sender')];
            case "15":
                return ["responseCode" => $responseCode, "success" => false, "message" => app('translator')->get('mobily.empty_numbers')];
            case "16":
                return ["responseCode" => $responseCode, "success" => false, "message" => app('translator')->get('mobily.empty_sender2')];
            case "17":
                return ["responseCode" => $responseCode, "success" => false, "message" => app('translator')->get('mobily.message_not_encoding')];
            case "18":
                return ["responseCode" => $responseCode, "success" => false, "message" => app('translator')->get('mobily.service_stoped')];
            case "19":
                return ["responseCode" => $responseCode, "success" => false, "message" => app('translator')->get('mobily.app_error')];
        }
    }
}
