<?php

namespace App\Traits;
use Twilio\Rest\Client;
use Modules\Setting\Model\BusinessSetting;

trait SendSMS
{
    public function sendIndividualSMS($number, $text)
    {
        $apy_key = env('SMS_API_KEY');

        try{
            $soapClient = new \SoapClient("https://api2.onnorokomSMS.com/sendSMS.asmx?wsdl");
            $paramArray = array(
                'apiKey' => $apy_key,
                'messageText' =>  $text,
                'numberList' => $number,
                'smsType' => "TEXT",
                'maskName' => '',
                'campaignName' => '',
            );
            $value = $soapClient->__call("NumberSms", array($paramArray));
                return $value;
        } catch (\Exception $e) {
                return  $e->getMessage();
        }

    }

    function sendSMS($to, $from, $text)
    {
        if (BusinessSetting::where('type','twillo_sms_gateway')->first()->status) {
            $sid = env("TWILIO_SID"); // Your Account SID from www.twilio.com/console
            $token = env("TWILIO_TOKEN"); // Your Auth Token from www.twilio.com/console

            $client = new Client($sid, $token);
            try {
                $message = $client->messages->create(
                  $to, // Text this number
                  array(
                    'from' => env('VALID_TWILLO_NUMBER'), // From a valid Twilio number
                    'body' => $text
                  )
                );
            } catch (\Exception $e) {

            }
        }
        elseif (BusinessSetting::where('type','text_to_local_sms')->first()->status) {
            // Account details
        	$apiKey = urlencode(env('TEXT_TO_LOCAL_API_KEY'));

        	// Message details
        	$numbers = array($to);
        	$sender = urlencode(env('TEXT_TO_LOCAL_SENDER'));
        	$message = rawurlencode($text);

        	$numbers = implode(',', $numbers);

        	// Prepare data for POST request
        	$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

        	// Send the POST request with cURL
        	$ch = curl_init('https://api.txtlocal.com/send/');
        	curl_setopt($ch, CURLOPT_POST, true);
        	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        	$response = curl_exec($ch);
        	curl_close($ch);

        	// Process your response here
        	return $response;
        }

    }

}
