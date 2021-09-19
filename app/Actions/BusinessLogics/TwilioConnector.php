<?php

namespace App\Actions\BusinessLogics;

class TwilioConnector
{
    /**
     * Initiates twilio call
     *
     * @return \Exception|string[]
     * @throws \Twilio\Exceptions\ConfigurationException
     */
    public function initiateCall($userPhone)
    {
        sleep(3);
        dd($userPhone);

        $encodedSalesPhone = urlencode(str_replace(' ','', getenv('TWILIO_SALES_PHONE')));

        // Create authenticated REST client using account credentials in
        // <project root dir>/.env.php
        $client = new \Twilio\Rest\Client(
            config('services.twilio.account_sid'),
            config('services.twilio.auth_token'),
        );

        try {
            $client->calls->create(
                $userPhone,
                config('services.twilio.number'),
                ["url"=> route('twilio.outbound-call', $encodedSalesPhone)]
            );

        } catch (\Exception $e) {
            // Failed calls will throw
            return $e;
        }

        // return a JSON response
        return array('message' => 'Call incoming!');
    }

    /**
     * Connects user to the call center
     *
     * @param $salesPhone
     * @return \Illuminate\Http\Response
     */
    public function connectCall($salesPhone)
    {
        // A message for Twilio's TTS engine to repeat
        $sayMessage = 'Thanks for contacting our sales department. Our
        next available representative will take your call.';

        $twiml = new \Twilio\TwiML\VoiceResponse();
        $twiml->say($sayMessage, array('voice' => 'alice'));
        $twiml->dial($salesPhone);

        $response = \Response::make($twiml, 200);
        $response->header('Content-Type', 'text/xml');

        return $response;
    }
}
