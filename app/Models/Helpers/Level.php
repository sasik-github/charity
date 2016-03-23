<?php
/**
 * User: sasik
 * Date: 3/23/16
 * Time: 11:03 AM
 */

namespace App\Models\Helpers;


use App\Models\Volunteer;

class Level
{
    CONST INITIAL_VALUE = 5;
    /**
     * @var Volunteer
     */
    private $volunteer;

    public function __construct(Volunteer $volunteer)
    {

        $this->volunteer = $volunteer;
    }

    function __toString()
    {
        return (string) $this->calculateLevelByExperience($this->volunteer);
    }


    private function calculateLevelByExperience(Volunteer $volunteer)
    {
        $exp = $volunteer->experience;

        if ($exp == 0 ) {
            return 0;
        }

        $level = floor(log(($exp / self::INITIAL_VALUE), 2) + 1);
        return $level;
    }
}