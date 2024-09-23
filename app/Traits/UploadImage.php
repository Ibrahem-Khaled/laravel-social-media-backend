<?php

namespace App\Traits;


use Illuminate\Support\Str;

trait UploadImage
{
    public function uploadImage($image, $path, $old_image = null)
    {
        if ($old_image) {
            $this->deleteImage($old_image);
        }

        $image_name = Str::uuid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path($path).'/images', $image_name);

        return 'images/'. $path . '/' . $image_name;
    }

    public function deleteImage($image)
    {
        if (file_exists(public_path($image)) && $image != 'default.jpg') {
            unlink(public_path($image));
        }
    }
}
