<?php

namespace App\Http\Controllers\Components;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class fileHandlerComponent extends Controller
{
    public function imageUpload($image, $fildName){

    	if($fildName){
            request()->validate([
                $fildName => 'mimes:jpg,jpeg,bmp,png',
            ],[
                $fildName.'.mimes' => 'Invalid file try to upload!'
            ]);

          if ($image){
            $real_image = $image;
            $imgNameWithExtention = "Fictionsoft".rand(8,8).time().
            '.'.$image->getClientOriginalExtension();
            Image::make($real_image)->resize(400,450)
            ->save( base_path('public/backend/uploadedImage/'
            .$imgNameWithExtention),'100');

            return $imgNameWithExtention;

        	}
        }
    }

    public function imageDelete($imageName){
    	if($imageName){
            file_exists('backend/uploadedImage/'.$imageName);
            unlink('backend/uploadedImage/'.$imageName);
        }
        return 0;
    }
}
