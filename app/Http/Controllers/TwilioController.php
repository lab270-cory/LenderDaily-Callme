<?php

namespace App\Http\Controllers;

use App\Actions\BusinessLogics\TwilioConnector;
use Illuminate\Http\Request;

class TwilioController extends Controller
{
    /**
     * Initiates call
     *
     * @return \Exception|string[]
     * @throws \Twilio\Exceptions\ConfigurationException
     */
    public function initiateCall(Request $request)
    {
        return (new TwilioConnector())->initiateCall($request->input('phone_number'));
    }

    public function connectCall($callCenterNumber)
    {
        return (new TwilioConnector())->connectCall($callCenterNumber);
    }
}
