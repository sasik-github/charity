<?php
/**
 * User: sasik
 * Date: 3/7/16
 * Time: 11:53 PM
 */

namespace App\Models;


class About extends BaseModel
{

    public static $rules = [
        'text' => 'required',
    ];

    protected $table = 'about';

    protected $fillable = [
        'id',
        'text',
    ];

    /**
     * @return About
     */
    public static function getAbout()
    {
        return self::findOrNew(1);
    }
}
