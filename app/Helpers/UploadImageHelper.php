<?php
namespace App\Helpers;
use Intervention\Image\Facades\Image;


trait UploadImageHelper
{
    public function resizeImage($image,$folder_name,$prefix)

    {
        if (!file_exists(public_path('uploads/' . $folder_name))) {
            $dir=public_path('uploads/' . $folder_name);
            mkdir($dir, 0777, true);
        }
        
        $prefix=$prefix."_";
        $input['file'] = $prefix.time().uniqid().'.'.explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];;
        $destinationPath = public_path('uploads/' . $folder_name);
        $imgFile = Image::make($image);
        $imgFile->save($destinationPath.'/'.$input['file']);
        return $input['file'];
   


    }
}
