<?php
namespace App\Http\traits;

trait media
{
   public function uploadPhoto($image,$folder){
    $photoName= uniqid() .'.'. $image->extension();
    $image->move(public_path('dist/img/'.$folder),$photoName);
    return $photoName;
   }
  public function deletePhoto($photoPath) {
    if (file_exists($photoPath)) {
        # code...
unlink($photoPath);
return true;
    }
    return false;
   }
}