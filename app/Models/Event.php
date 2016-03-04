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
    ];

    public static $rules = [
        'name',
        'description',
        'image',
        'points',
        'date',
    ];
}