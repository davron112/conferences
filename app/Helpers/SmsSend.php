<?php
namespace App\Helpers;

 class SmsSend {

     /**
      * @param $phone
      * @param $text
      * @return bool|string
      */
     public static function sendSms($phone, $text) {
         $data = [
             'recipient_number' => "+". $phone,
             'message' => $text,
             'app_id' => config('services.sms.app_id')
         ];

         $url = 'https://smsapi.uz/api/v1/sms/send';
         $headers = [
             'Authorization: Bearer ' . config('services.sms.api_key'),
             'Content-Type: application/json'
         ];

         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL,$url);
         curl_setopt($ch, CURLOPT_POST, true);
         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
         curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
         $result = curl_exec($ch);
         curl_close($ch);
         return $result;
     }
 }
