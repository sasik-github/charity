<?php
/**
 * User: sasik
 * Date: 3/4/16
 * Time: 10:49 AM
 */

namespace App\Models;


use App\Models\Modifications\WithOrganizationEvent;

class Volunteer extends BaseModel
{

    protected $table = 'volunteers';

    protected $fillable = [
        'birthday',
        'workplace',
        'image',
        'points',
    ];

    public static $rules = [
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

    public function WithOrganizerEvents()
    {
        return $this->belongsToMany(WithOrganizationEvent::class, 'rel_volunteer_event', 'volunteer_id', 'event_id');
    }

    public function increasePoints($value)
    {
        $this->points = $this->points + (int) $value;
        return $this;
    }

    public function visitEvent(Event $event)
    {
        if (!$event->isVisited($this)) {
            $this->increasePoints($event->points);
            $event->visit($this);
        }
    }

}
