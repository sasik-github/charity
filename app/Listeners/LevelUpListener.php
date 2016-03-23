<?php
/**
 * User: sasik
 * Date: 3/23/16
 * Time: 4:47 PM
 */

namespace App\Listeners;


use App\Events\LevelUpEvent;
use App\Models\Helpers\Level;
use App\Models\Volunteer;
use App\Push\PushHandler;

class LevelUpListener
{
    
    /**
     * @var PushHandler
     */
    private $pushHandler;

    public function __construct(PushHandler $pushHandler)
    {

        $this->pushHandler = $pushHandler;
    }

    public function handle(LevelUpEvent $event)
    {
        $this->sendNotificationAboutLevelUp($event->volunteer);
    }

    private function sendNotificationAboutLevelUp(Volunteer $volunteer)
    {
        $tokens = $volunteer->user->tokens;

        $level = new Level($volunteer);

        $data = $this->generateData($level->toInt());

        foreach ($tokens as $token) {
            $response = $this->pushHandler->makePush($token, $data);
        }
    }

    private function generateData($level)
    {
        return [
            'message' => 'Поздравляем! Вы достигли ' . $level . ' уровня.'
        ];
    }


}