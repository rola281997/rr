<?php

namespace App\Services;
use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Helpers\UploadImageHelper;
use App\Repository\HeaderAndFooterRepository;
class HeaderAndFooterService
{
    use UploadImageHelper;
    private $headerAndFooterRepository;

    public function __construct(HeaderAndFooterRepository $headerAndFooterRepository)
    {
        $this->headerAndFooterRepository = $headerAndFooterRepository;
    }
    public function update($data)
    {
        $saved_data = [
            'title_ar' => $data['title_ar'],
            'title_en'=>$data['title_en'],
            'description_ar'=>$data['description_ar'],
            'description_en'=>$data['description_en']
        ];
        if($data['logo']){
            $image_path=$this->resizeImage($data['logo'],'headers','logo');
            $old_img_name = $this->headerAndFooterRepository->getField(1, 'logo');
            if ($old_img_name != null) {
                File::delete(public_path('uploads/headers/' . $old_img_name));
            }
            $saved_data=[
                'logo'=>$image_path
            ];
        }
        #$saved_data=$this->handleUpdateRequest($data);
        return $this->headerAndFooterRepository->update($saved_data, 1);
    }

    private function handleUpdateRequest($data){
        $new_data=[];
        if(key_exists('title_ar',$data)&&$data['title_ar'] !=null){
            $new_data['title_ar']=$data['title_ar'];
        }
        if(key_exists('title_en',$data)&&$data['title_en'] !=null){
            $new_data['title_en']=$data['title_en'];
        }
        if(key_exists('description_ar',$data)&&$data['description_ar'] !=null){
            $new_data['description_ar']=$data['description_ar'];
        }
        if(key_exists('description_en',$data)&&$data['description_en'] !=null){
            $new_data['description_en']=$data['description_en'];
        }
        return $new_data;
    }

    public function findWhere($data)
    {
        return $this->headerAndFooterRepository->findWhere($data);
    }

    public function uploadImage($image){
        $image_path=$this->resizeImage($image,'headers','logo');
        $old_img_name = $this->headerAndFooterRepository->getField(1, 'logo');
        if ($old_img_name != null) {
            File::delete(public_path('uploads/headers/' . $old_img_name));
        }
        $saved_data=[
            'logo'=>$image_path
        ];
        return $this->headerAndFooterRepository->update($saved_data, 1);
    }

    


}
