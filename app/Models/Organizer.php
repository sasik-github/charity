<?php
/**
 * User: sasik
 * Date: 3/6/16
 * Time: 4:30 PM
 */

namespace App\Models;


class Organizer extends BaseModel
{
    public static $rules = [
        'name' => 'required',
        'description' => 'required',
        'manager' => 'required',
        'contacts' => 'required',
//        'image' => 'required',
        'address' => 'required',
    ];

    protected $table = 'organizers';

    protected $fillable = [
        'name',
        'description',
        'manager',
        'contacts',
        'image',
        'address',
    ];
}
