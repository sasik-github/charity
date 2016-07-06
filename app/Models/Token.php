<?php
/**
 * User: sasik
 * Date: 3/14/16
 * Time: 2:53 PM
 */

namespace App\Models;


class Token extends BaseModel
{
    const TYPE_ANDROID = 1;

    const TYPE_IOS = 2;

    protected $table = 'tokens';

    protected $fillable = [
        'token',
        'device_type_id',
        'user_id',
    ];

    public $timestamps = false;

}
