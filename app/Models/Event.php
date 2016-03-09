<?php
/**
 * User: sasik
 * Date: 3/4/16
 * Time: 10:48 AM
 */

namespace App\Models;


class Event extends BaseModel
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'points',
        'date',
        'place',
        'organizer_id',
        'volunteer_id',
    ];

    public static $rules = [
        'name' => 'required',
        'description' => 'required',
        'image',
        'points' => 'required',
        'date' => 'required',
        'organizer_id' => 'required|exists:organizers,id',
        'volunteer_id' => 'required|exists:volunteers,id',
    ];

    protected $dates = [
        'date',
    ];

    public function volunteers()
    {
        return $this->belongsToMany(Volunteer::class, 'rel_volunteer_event', 'event_id', 'volunteer_id');
    }

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }
}
