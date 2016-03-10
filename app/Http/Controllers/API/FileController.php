<?php
/**
 * User: sasik
 * Date: 3/10/16
 * Time: 3:46 PM
 */

namespace App\Http\Controllers\API;


use App\Files\FileSystem;
use Illuminate\Http\Request;

class FileController
{
    public function upload(Request $request, FileSystem $fileSystem)
    {
        $file = $request->file('file');
        return ['name' => $fileSystem->getFilename($file)];
    }
}