<?php
/**
 * User: sasik
 * Date: 3/4/16
 * Time: 10:49 AM
 */

namespace App\Models;


class Volunteer extends BaseModel
{

    protected $table = 'volunteers';

    protected $fillable = [
        'user_id',
        'birthday',
        'workplace',
        'image',
        'points',
    ];

    public static $rules = [
        'user_id',
        'birthday',
        'workplace',
        'image',
        'points',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getNameAttribute($value)
    {
        if ($this->user) {
            //может быть надо кинуть исключение!? потому что У ВОЛОНТЕРА ДОЛЖЕН БЫТЬ ПОЛЬЗОВАТЕЛЬ
            return $this->user->name;
        }

        return null;
    }

    public function getTelephoneAttribute($value)
    {
        if ($this->user) {
            return $this->user->telephone;
            //может быть надо кинусть исключение!? потому что У ВОЛОНТЕРА ДОЛЖЕН БЫТЬ ПОЛЬЗОВАТЕЛЬ
        }

        return null;
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'rel_volunteer_event', 'volunteer_id', 'event_id');
    }
}
