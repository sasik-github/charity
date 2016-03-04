<?php
namespace App\Models\Repositories;

use App\Models\User;
use App\Models\Volunteer;

/**
 * User: sasik
 * Date: 3/4/16
 * Time: 2:54 PM
 */
class VolunteerRepository
{

    /**
     * создает пользователя и присоединяет волонтерка к нему
     * @param array $attributes
     * @return Volunteer
     */
    public function create(array $attributes)
    {
        $user = User::create($attributes);
        $volunteer = Volunteer::create($attributes);
        $volunteer
            ->user()
            ->associate($user);
        $volunteer->save();

        return $volunteer;
    }

    public function getValidationRules()
    {
        $rules = Volunteer::$rules;
        $rules = array_merge($rules, User::$rules);
        $rules['password'] = 'required|min:6';
//        $rules['telephone'] = 'required|min:6';
        return $rules;
    }
}