<?php

namespace App\Classes;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Twilio\Jwt\ClientToken;
use App\Models\SMS as Message;

/**
 *
 */
class SMS
{
    public $number;

    public $message;

    public function dispatch()
    {
        if (config('app.env') !== 'production') {
            return;
        }

        if (config('app.disable_sms')) {
            return true;
        }

        $number = ps($this->number);
        $message = strip_tags($this->message);
        $message = str_replace('&nbsp;', ' ', $message);

        // $number = '+15878960009';
        $accountSid = (config('app.sms.TEST') ? config('app.sms')['SMS_TEST_SID'] : config('app.sms')['SMS_SID']);
        $authToken  = (config('app.sms.TEST') ? config('app.sms')['SMS_TEST_AUTH_TOKEN'] : config('app.sms')['SMS_AUTH_TOKEN']);

        $client = new Client($accountSid, $authToken);

        if ($number === '+15878960009') {
            return;
        }

        try {
            $res = $client->messages->create(
                $number,
                array(
                    'from' => (config('app.sms.TEST') ? config('app.sms.SMS_TEST_FROM_NUMBER') : config('app.sms.SMS_FROM_NUMBER')),
                    'body' => $message
                )
            );

            Message::create([
                'number' => $number,
                'message' => $message,
                'sid' => $res->sid,
                'ip' => ipAddress()
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 422);
        }
    }

    public function to($number)
    {
        $this->number = $number;

        return $this;
    }

    public function send($obj)
    {
        $this->message = $obj->build()->render();

        return $this->dispatch();
    }
}
