<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image; 

class PhotoUploadController extends Controller
{
    public static function imageUpload(string $name, int $height, int $width,string $path, $file)
    {
        $image_name = $name.'.webp'; 
        Image::make($file)
        ->fit($width, $height)
        ->save(public_path($path).$image_name, 50, 'webp');
        return $image_name; 

    }

    public static function imageUnlink($path, $name):void
    {
      $image_path = public_path($path).$name; 
      if(file_exists($image_path)){
        unlink($image_path); 
      }
    }
}
