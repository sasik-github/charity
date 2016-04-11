<?php
namespace App\Models\Repositories;

use App\Models\User;

/**
 * User: sasik
 * Date: 2/22/16
 * Time: 9:04 PM
 */
class UserRepository
{


    /**
     * @param $telephone
     * @return User
     */
    public function getUserByTelephone($telephone)
    {
        return User::where('telephone', $telephone)->first();
    }
}