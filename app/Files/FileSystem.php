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

    const NO_IMAGE = 'images/no_image.png';

    public function getFilename(UploadedFile $file)
    {
        $filename = uniqid();
        $dest = self::PATH_TO_FILES;
        $filenameFull = $filename . "." . $file->getClientOriginalExtension();
        $file->move($dest, $filenameFull);
        return $filenameFull;
    }

    /**
     * @deprecated
     * @param $attributes
     * @return null
     *
     */
    public function getFilenameFromPost($attributes)
    {
        return ImageHandler::handle($attributes);
    }

    public function path($imageName)
    {
        if (empty($imageName)) {
            return '/' . self::NO_IMAGE;
        }

        return '/' . self::PATH_TO_FILES . $imageName;
    }
}
