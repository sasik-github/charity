<?php
namespace App\Files;

use Illuminate\Http\UploadedFile;

/**
 * User: sasik
 * Date: 3/10/16
 * Time: 3:49 PM
 */
class FileSystem
{

    const PATH_TO_FILES = 'files/';

    const NO_IMAGE = 'images/no-image.jpg';

    public function getFilename(UploadedFile $file)
    {
        $filename = str_random(12);
        $dest = self::PATH_TO_FILES;

        $filenameFull = $filename . "_" . $file->getClientOriginalName();
        $filenameFull = str_replace("#", "_", $filenameFull);
        $file->move($dest, $filenameFull);
        return $filenameFull;
    }

    public function getFilenameFromPost($attributes)
    {
        if (!array_key_exists('filename', $attributes)) {
            return null;
        }

        return $attributes['filename'][0];
    }
}
