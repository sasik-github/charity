<?php

namespace App\Listeners;

use App\Events\GrantPointsEvent;
use App\Models\Event;
use App\Models\Helpers\PluralForm;
use App\Models\Volunteer;
use App\Push\PushHandler;

/**
 * User: sasik
 * Date: 3/23/16
 * Time: 9:50 AM
 */
class GrantPointsListener
{
    /**
     * @var PushHandler
     */
    private $pushHandler;

    public function __construct(PushHandler $pushHandler)
    {

        $this->pushHandler = $pushHandler;
    }

    public function handle(GrantPointsEvent $event)
    {
        $this->handleGrantPointsPush($event->volunteer, $event->event);
    }

    /**
     * @param Volunteer $volunteer
     * @param Event $event
     */
    private function handleGrantPointsPush(Volunteer $volunteer, Event $event)
    {
        $tokens = $volunteer->user->tokens;
        $data = $this->generateGrantPointsData($event);
        foreach ($tokens as $token) {
            /**
             * @var $token Token
             */

            $response = $this->pushHandler->makePush($token, $data);
        }
    }

    private function generateGrantPointsData(Event $event)
    {
        return [
            'message' => 'Вы получили ' . $event->points . ' ' . (new PluralForm($event->points, Event::$forms)) . ' за участие в "' . $event->name . '"',
        ];
    }
}