<?php

namespace App\Http\Controllers\Components;

use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Route;

class fileHandlerComponent extends Controller
{
    public function currentController(){
        return strtolower(str_replace('Controller', '', class_basename(Route::current()->controller)));
    }

    public function imageUpload($image, $fildName){

    	if($fildName){
            request()->validate([
                $fildName => 'mimes:jpg,jpeg,bmp,png',
            ],[
                $fildName.'.mimes' => 'Invalid file try to upload!'
            ]);

            if ($image) {

                $real_image = $image;
                $image_name = "Fictionsoft-" . rand(8, 8) . time() . '.' . $image->getClientOriginalExtension();
                Image::make($real_image)->save(base_path('public/backend/uploads/images/' . $this->currentControlle() . '/' . $image_name, '100'));

                return $image_name;
            }
        }
    }

    public function imageDelete($imageName){

        $imagePath = 'backend/uploads/images/'.$this->currentController().'/'.$imageName;

    	if(file_exists($imagePath)){
            unlink($imagePath);
            return 0;
        }
    }
}
