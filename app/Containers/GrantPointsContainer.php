<?php


namespace App\Containers;


use Illuminate\Support\Collection;

class GrantPointsContainer
{
    private $affectedVolunteers = 0;

    private $lvlUppedVolunteers = 0;

    public function lvlUp()
    {
        $this->lvlUppedVolunteers++;
    }

    public function grantPoints()
    {
        $this->affectedVolunteers++;
    }

    public function toArray()
    {
        return [
            'affected_volunteers' => $this->affectedVolunteers,
            'lvl_upped_volunteers' => $this->lvlUppedVolunteers,
        ];
    }
}
