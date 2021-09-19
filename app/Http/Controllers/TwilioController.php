<?php

namespace App\Http\Controllers;

use App\Actions\BusinessLogics\TwilioConnector;

class TwilioController extends Controller
{
    /**
     * Initiates call
     *
     * @return \Exception|string[]
     * @throws \Twilio\Exceptions\ConfigurationException
     */
    public function initiateCall()
    {
        return (new TwilioConnector())->initiateCall();
    }

    public function connectCall($callCenterNumber)
    {
        return (new TwilioConnector())->connectCall($callCenterNumber);
    }
}
