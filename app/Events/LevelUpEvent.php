<?php
/**
 * User: sasik
 * Date: 3/23/16
 * Time: 4:45 PM
 */

namespace App\Events;


use App\Models\Volunteer;
use Illuminate\Queue\SerializesModels;

class LevelUpEvent extends Event
{
    use SerializesModels;

    /**
     * @var Volunteer
     */
    public $volunteer;

    public function __construct(Volunteer $volunteer)
    {
        $this->volunteer = $volunteer;
    }
}