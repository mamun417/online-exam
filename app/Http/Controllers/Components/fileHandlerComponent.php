<?php

namespace App\Http\Controllers\Components;

use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use phpDocumentor\Reflection\Types\This;
use Route;

class fileHandlerComponent extends Controller
{
    public static function currentController(){
        return strtolower(str_replace('Controller', '', class_basename(Route::current()->controller)));
    }

    public static function imageUpload($image, $fildName){

    	if($fildName){
            request()->validate([
                $fildName => 'mimes:jpg,jpeg,bmp,png',
            ],[
                $fildName.'.mimes' => 'Invalid file try to upload!'
            ]);

            if ($image) {

                $real_image = $image;
                $image_name = "Fictionsoft-" . rand(8, 8) . time() . '.' . $image->getClientOriginalExtension();
                Image::make($real_image)->save(base_path('public/admin/uploads/images/' . self::currentController() . '/' . $image_name, '100'));

                return $image_name;
            }
        }
    }

    public static function imageDelete($imageName){

        $imagePath = 'admin/uploads/images/'.self::currentController().'/'.$imageName;

    	if(file_exists($imagePath)){
            unlink($imagePath);
            return 0;
        }
    }
}
