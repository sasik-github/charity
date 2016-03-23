<?php
/**
 * User: sasik
 * Date: 3/23/16
 * Time: 9:53 AM
 */

namespace App\Events;


use App\Models\Event as VolunteerEvent;
use App\Models\Volunteer;
use Illuminate\Queue\SerializesModels;

class GrantPointsEvent extends Event
{
    use SerializesModels;

    /**
     * @var VolunteerEvent
     */
    public $event;

    /**
     * @var Volunteer
     */
    public $volunteer;

    public function __construct(Volunteer $volunteer, VolunteerEvent $event)
    {
        $this->event = $event;
        $this->volunteer = $volunteer;
    }
}