<?php

namespace App\Http\Controllers;

use App\Actions\BusinessLogics\TwilioConnector;
use App\Models\CallWidget;
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
        $callCenterPhone = CallWidget::whereIdentifier($request->input('identifier'))->value('call_center_number');
        return (new TwilioConnector())->initiateCall($request->input('phone_number'), $callCenterPhone);
    }

    public function connectCall($callCenterNumber)
    {
        return (new TwilioConnector())->connectCall($callCenterNumber);
    }
}
