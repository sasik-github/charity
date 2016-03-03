<?php
/**
 * User: sasik
 * Date: 3/3/16
 * Time: 10:56 AM
 */

namespace App\Models;


class News extends BaseModel
{
    protected $table = 'newses';

    public static $rules = [
        'title' => 'required',
        'text' => 'required',
    ];
    protected $fillable = [
        'title',
        'text',
        'image',
    ];
}