<?php
/**
 * User: sasik
 * Date: 3/14/16
 * Time: 2:53 PM
 */

namespace App\Models;


class Token extends BaseModel
{

    protected $table = 'tokens';

    protected $fillable = [
        'token',
        'device_type_id',
        'user_id',
    ];

    public $timestamps = false;

}