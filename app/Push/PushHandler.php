<?php

namespace App\Push;

use App\Models\Event;
use App\Models\Helpers\PluralForm;
use App\Models\Token;
use App\Models\Volunteer;
use Sasik\GCM\CloudMessaging;
use Sasik\GCM\ResponseCode;

/**
 * User: sasik
 * Date: 3/23/16
 * Time: 10:14 AM
 */
class PushHandler
{

    public function makePush(Token $token, $data)
    {
        $response = CloudMessaging::sendToAndroid($token->token, $data);
        $code = ResponseCode::fromResponse($response);

        if (ResponseCode::NOT_REGISTERED === $code || ResponseCode::UNKNOWN_ERROR === $code) {
            $token->delete();
        }
//        \Log::debug('PushHandler:Response', [ResponseCode::getMessageFromCode($code)]);
        return ResponseCode::getMessageFromCode($code);
    }

}
