<?php


namespace App\Helper;


use Illuminate\Support\Facades\Storage;
use File;

class Upload
{

    public static function uploadImage($image, $path, $oldImage = null)
    {
        $name = time() . '.' . $image->getClientOriginalExtension();
        Storage::disk('public')->put($path . '/' . $name, File::get($image));

        if (!is_null($oldImage)) {
            $imageName = strstr($oldImage, $path);
            Storage::disk('public')->delete($imageName);
        }
        return url('/') . '/uploads/' . $path . '/' . $name;
    }

    public static function uploadImages($images, $path)
    {
        $imagesName = [];
        foreach ($images as $image) {
            $name = time() . '_' . rand(0, 10000) . '.' . $image->getClientOriginalExtension();
            Storage::disk('public')->put($path . '/' . $name, File::get($image));
            $imagesName[] = url('/') . '/uploads/' . $path . '/' . $name;
        }
        return $imagesName;
    }

    public static function deleteImage($image, $path)
    {
        $imageName = strstr($image, $path);
        Storage::disk('public')->delete($imageName);
    }

    public static function deleteDirectory($path)
    {
        Storage::disk('public')->deleteDirectory($path);
    }
}
