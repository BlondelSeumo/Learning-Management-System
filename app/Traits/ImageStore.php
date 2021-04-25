<?php

namespace App\Traits;

use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use File;

trait ImageStore
{
    public function saveImage($image, $height = null ,$lenght = null)
    {
        if(isset($image)){

            $current_date  = Carbon::now()->format('d-m-Y');

            if(!File::isDirectory('uploads/images/'.$current_date)){

                File::makeDirectory('uploads/images/'.$current_date, 0777, true, true);

            }

           $image_extention = str_replace('image/','',Image::make($image)->mime());

           if($height != null && $lenght != null ){
               $img = Image::make($image)->resize($height, $lenght);
           }else{
               $img = Image::make($image);
           }

           $img_name = 'uploads/images/'.$current_date.'/'.uniqid().'.'.$image_extention;
           $img->save($img_name);

           return $img_name;

        }else{

            return null ;
        }

    }

    public function deleteImage($url)
    {
        if(isset($url)){

            if (File::exists($url)) {

                File::delete($url);

                return true;

            }else{
                return false;
            }

        }else{

            return null ;
        }

    }

    public function saveAvatar($image, $height = null ,$lenght = null)
    {
        if(isset($image)){

            $current_date  = Carbon::now()->format('d-m-Y');

            if(!File::isDirectory('uploads/avatar/'.$current_date)){

                File::makeDirectory('uploads/avatar/'.$current_date, 0777, true, true);

            }

           $image_extention = str_replace('image/','',Image::make($image)->mime());

           if($height != null && $lenght != null ){
               $img = Image::make($image)->resize($height, $lenght);
           }else{
               $img = Image::make($image);
           }

           $img_name = 'uploads/avatar/'.$current_date.'/'.uniqid().'.'.$image_extention;
           $img->save($img_name);

           return $img_name;

        }else{

            return null ;
        }

    }
}
