<?php
/**
 * User: sasik
 * Date: 3/23/16
 * Time: 5:33 PM
 */

namespace App\Models\Helpers;


use App\Models\Volunteer;

class LevelUpChecker
{


    /**
     * @var Volunteer
     */
    private $volunteer;
    private $endLevel;
    private $startLevel;

    public function __construct(Volunteer $volunteer)
    {

        $this->volunteer = $volunteer;

        $this->start();
    }

    public function start()
    {
        $this->startLevel = (new Level($this->volunteer))->toInt();
    }

    public function end()
    {
        $this->endLevel = (new Level($this->volunteer))->toInt();
    }

    /**
     * @return bool
     */
    public function isLevelUped()
    {
        if ($this->endLevel == null)
            $this->end();

        return $this->startLevel == $this->endLevel;
    }
}