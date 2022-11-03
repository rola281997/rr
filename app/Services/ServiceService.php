<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use App\Helpers\UploadImageHelper;
use App\Repository\ServiceRepository;
class ServiceService
{
    use UploadImageHelper;
    private $serviceRepository;

    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function create($data)
    {
        $saved_data = [
            'title_ar' => $data['title_ar'],
            'title_en' => $data['title_en'],
            'description_ar'=>$data['description_ar'],
            'description_en'=>$data['description_en'],
        ];
        $image_path=$this->resizeImage($data['image'],'services/images','service');
        $saved_data['image']=$image_path;
        $image_path=$this->resizeImage($data['icon'],'services/icons','service');
        $saved_data['icon']=$image_path;
        return $this->serviceRepository->create($saved_data);
    }
    public function update($data,$id)
    {
        $saved_data = [
            'title_ar' => $data['title_ar'],
            'title_en' => $data['title_en'],
            'description_ar'=>$data['description_ar'],
            'description_en'=>$data['description_en'],
        ];
        if($data['image']){
            $image_path=$this->resizeImage($data['image'],'services/images','service');
            $old_img_name = $this->serviceRepository->getField($id, 'image');
            if ($old_img_name != null) {
                File::delete(public_path('uploads/services/images/' . $old_img_name));
            }
            $saved_data['image']=$image_path;
        }
        if($data['icon']){
            $image_path=$this->resizeImage($data['icon'],'services/icons','service');
            $old_img_name = $this->serviceRepository->getField($id, 'icon');
            if ($old_img_name != null) {
                File::delete(public_path('uploads/services/icons/' . $old_img_name));
            }
            $saved_data['icon']=$image_path;
        }
        
        return $this->serviceRepository->update($saved_data, $id);
    }
    public function findWhere($data)
    {
        return $this->serviceRepository->findWhere($data);
    }

    public function findAll()
    {
        return $this->serviceRepository->all();
    }

    public function delete($id)
    {
        $service=$this->serviceRepository->findWhere(['id'=>$id])->first();
        $old_img_name = $this->serviceRepository->getField($id, 'image');
        if ($old_img_name != null) {
            File::delete(public_path('uploads/services/images/' . $old_img_name));
        }
        $old_img_name = $this->serviceRepository->getField($id, 'icon');
        if ($old_img_name != null) {
            File::delete(public_path('uploads/services/icons/' . $old_img_name));
        }
        return $service->delete();
    }

    


}
