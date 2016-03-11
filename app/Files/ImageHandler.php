<?php
/**
 * User: sasik
 * Date: 3/11/16
 * Time: 11:55 AM
 */

namespace App\Files;


class ImageHandler
{

    /**
     * проверяет параметры на наличие картинки загруженой с помощью dropzone
     * @param array $attributes
     * @return null
     */
    public static function handle(array $attributes = [])
    {
        if (!array_key_exists('filename', $attributes)) {
            return null;
        }

        return $attributes['filename'][0];
    }
}