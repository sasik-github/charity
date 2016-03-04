<?php
/**
 * User: sasik
 * Date: 3/4/16
 * Time: 10:49 AM
 */

namespace App\Models;


class Volunteer extends BaseModel
{
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
}