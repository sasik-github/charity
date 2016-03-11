<?php
/**
 * User: sasik
 * Date: 3/3/16
 * Time: 10:56 AM
 */

namespace App\Models;


use App\Files\ImageHandler;

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

    /**
     * @param array $attributes
     * @return News
     */
    public static function  create(array $attributes = [])
    {
        $attributes['image'] = self::getImageName($attributes);
        return parent::create($attributes);
    }

    public function update(array $attributes = [], array $options = [])
    {
        $attributes['image'] = self::getImageName($attributes);
        return parent::update($attributes, $options);
    }

    protected static function getImageName($attributes)
    {
        return ImageHandler::handle($attributes);
    }
}