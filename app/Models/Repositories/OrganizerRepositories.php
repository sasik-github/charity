<?php
/**
 * User: sasik
 * Date: 3/6/16
 * Time: 4:36 PM
 */

namespace App\Models\Repositories;


use App\Models\Organizer;

class OrganizerRepositories
{

    /**
     * @return array
     */
    public function getOrganizersForSelectbox()
    {
        return Organizer::all()->pluck('name', 'id')->toArray();
    }
}
