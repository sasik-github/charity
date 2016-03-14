<?php
/**
 * User: sasik
 * Date: 3/4/16
 * Time: 10:48 AM
 */

namespace App\Models;


use Carbon\Carbon;

class Event extends BaseModel
{

    protected $table = 'events';

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

    public function scopePast($query)
    {
        $now = Carbon::now()->startOfDay();
        return $query->where('date', '<=', $now);
    }

    public function volunteers()
    {
        return $this->belongsToMany(Volunteer::class, 'rel_volunteer_event', 'event_id', 'volunteer_id');
    }

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }

    public function toArray()
    {
        $res = parent::toArray();
        $res['type'] = 'event';
        return $res;
    }

//    protected $dateFormat = 'd.m.Y H:m';
//    dd(Carbon::createFromFormat('d.m.Y H:m', $request->get('date')));
}
