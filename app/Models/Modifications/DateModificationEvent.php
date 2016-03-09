<?php

namespace  App\Models\Modifications;

use App\Models\Event;
use Carbon\Carbon;

/**
 * User: sasik
 * Date: 3/9/16
 * Time: 8:34 PM
 */
class DateModificationEvent extends Event
{

    // 2016-03-26
    public function getDateAttribute($value)
    {
        $date = new Carbon($this->attributes['date']);
        return $date->format('Y-m-d');
    }
}
