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
    

    public function push()
    {
        
    }

    public function handleGrantPointsPush(Volunteer $volunteer, Event $event)
    {
        $tokens = $volunteer->user->tokens;
        $data = $this->generateGrantPointsData($event);
        foreach ($tokens as $token) {
            /**
             * @var $token Token
             */

            $response = $this->makePush($token, $data);
        }
    }


    private function makePush(Token $token, $data)
    {
        $response = CloudMessaging::send($token->token, $data);
        $code = ResponseCode::fromResponse($response);

        if (ResponseCode::NOT_REGISTERED === $code || ResponseCode::UNKNOWN_ERROR === $code) {
            $token->delete();
        }
//        \Log::debug('PushHandler:Response', [ResponseCode::getMessageFromCode($code)]);
        return ResponseCode::getMessageFromCode($code);
    }

    private function generateGrantPointsData(Event $event)
    {
        return [
            'message' => 'Вы получили ' . $event->points . ' ' . (new PluralForm($event->points, Event::$forms)) . ' за участие в "' . $event->name . '"',
        ];
    }

}