<?php

namespace App\Listeners;

use App\Events\GrantPointsEvent;
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
        $this->pushHandler->handleGrantPointsPush($event->volunteer, $event->event);
    }
}