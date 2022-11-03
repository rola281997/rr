<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use App\Helpers\UploadImageHelper;
use App\Repository\ClientRepository;
class ClientService
{
    use UploadImageHelper;
    private $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function create($data)
    {
        $saved_data = [
            'name_en' => $data['name_en'],
            'name_ar' => $data['name_ar'],
        ];
        $image_path=$this->resizeImage($data['image'],'clients','client');
        $saved_data['image']=$image_path;
        return $this->clientRepository->create($saved_data);
    }
    public function update($data,$id)
    {
        $saved_data = [
            'name_en' => $data['name_en'],
            'name_ar' => $data['name_ar'],
        ];
        if($data['image']){
            $image_path=$this->resizeImage($data['image'],'clients','client');
            $old_img_name = $this->clientRepository->getField($id, 'image');
            if ($old_img_name != null) {
                File::delete(public_path('uploads/clients/' . $old_img_name));
            }
            $saved_data['image']=$image_path;
        }
        
        return $this->clientRepository->update($saved_data, $id);
    }
    public function findWhere($data)
    {
        return $this->clientRepository->findWhere($data);
    }

    public function findAll()
    {
        return $this->clientRepository->all();
    }

    public function delete($id)
    {
        $client=$this->clientRepository->findWhere(['id'=>$id])->first();
        $old_img_name = $this->clientRepository->getField($id, 'image');
        if ($old_img_name != null) {
            File::delete(public_path('uploads/clients/' . $old_img_name));
        }
        return $client->delete();
    }

    


}
