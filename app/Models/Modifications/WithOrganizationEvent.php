<?php
/**
 * User: sasik
 * Date: 3/10/16
 * Time: 11:52 AM
 */

namespace App\Models\Modifications;


use App\Models\Event;

class WithOrganizationEvent extends Event
{
    public function toArray()
    {
        $result = parent::toArray();

        $result['organizer'] = $this->getOrganizerInfo();

        return $result;
    }

    private function getOrganizerInfo()
    {
        return [
            'name' => $this->organizer->name,
            'image' => $this->organizer->image,
        ];
    }
}