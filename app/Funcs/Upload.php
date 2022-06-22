<?php

namespace App\Funcs;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class Upload
{
    public static function upload(?UploadedFile $file, $name, $path): ?string
    {
        if (!is_null($file) && $file->isValid()) {
            $extension = $file->getClientOriginalExtension();
            self::createDirectory($path);
            $file->move(public_path($path), "$name.$extension");
            return $path . "/$name.$extension";
        }
        return null;
    }

    public static function createDirectory($path): void
    {
        $dir = public_path($path);
        if (!File::isDirectory($dir))
            File::makeDirectory($dir, 0777, true, true);
    }
}
