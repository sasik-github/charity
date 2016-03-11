<?php
/**
 * User: sasik
 * Date: 3/11/16
 * Time: 1:54 PM
 */

namespace App\Models\Modifications;


use App\Files\ImageHandler;

/**
 * Class ModelWithImageTrait
 * оброботка create & update  моделей c картинками image
 * @package App\Models\Modifications
 */
trait ModelWithImageTrait
{

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