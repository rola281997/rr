<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use App\Helpers\UploadImageHelper;
use App\Repository\ProjectImageRepository;
use App\Repository\ProjectRepository;

class ProjectService
{
    use UploadImageHelper;
    private $projectRepository;
    private $projectImageRepository;
    public function __construct(ProjectRepository $projectRepository,ProjectImageRepository $projectImageRepository)
    {
        $this->projectRepository = $projectRepository;
        $this->projectImageRepository = $projectImageRepository;
    }

    public function create($data)
    {
        $saved_data = [
            'name_en' => $data['name_en'],
            'name_ar' => $data['name_ar'],
            'description_en' => $data['description_en'],
            'description_ar' => $data['description_ar'],
            'category_id'=>$data['category_id']
        ];
        $image_path=$this->resizeImage($data['image'],'projects','project');
        $saved_data['image']=$image_path;
        $proj=$this->projectRepository->create($saved_data);
        if($data['images'] !=[]){
            foreach ($data['images'] as $img){
                $image_path=$this->resizeImage($img,'projects_images','project_image');
                $data=[
                    "project_id"=>$proj->id,
                    "name"=>$image_path
                ];
                $this->projectImageRepository->create($data);
            }
        }
        return $proj;
    }

    public function update($data,$id)
    {
        $saved_data = [
            'name_en' => $data['name_en'],
            'name_ar' => $data['name_ar'],
            'description_en' => $data['description_en'],
            'description_ar' => $data['description_ar'],
            'category_id'=>$this->projectRepository->getField($id, 'category_id')
        ];
        if($data['image']){
            $image_path=$this->resizeImage($data['image'],'projects','project');
            $old_img_name = $this->projectRepository->getField($id, 'image');
            if ($old_img_name != null) {
                File::delete(public_path('uploads/projects/' . $old_img_name));
            }
            $saved_data['image']=$image_path;
        }
        $proj=$this->projectRepository->update($saved_data,$id);
        if($data['images'] !=[]){
            foreach ($data['images'] as $img){
                $image_path=$this->resizeImage($img,'projects_images','project_image');
                $data=[
                    "project_id"=>$proj->id,
                    "name"=>$image_path
                ];
                $this->projectImageRepository->create($data);
                
            }
        }
        return $proj;
        
       
    }
    
    public function uploadProjectImages($data){
        $images_arr=[];
        $proj = $this->findWhere(['id'=>$data['project_id']])->first();
        if($data['images'] !=[]){
            foreach ($data['images'] as $img){
                $image_path=$this->resizeImage($img,'projects_images','project_image');
                $data=[
                    "project_id"=>$proj->id,
                    "name"=>$image_path
                ];
                $image=$this->projectImageRepository->create($data);
                array_push($images_arr,$image);
            }
        }
        return $images_arr;
    }

    public  function deleteOldImages($id)
    {
        $images=$this->projectImageRepository->findwhere(['project_id'=>$id]);
        if(!empty($images)){
            foreach($images as $img){
                File::delete(public_path('uploads/projects_images/' . $img->name));
            }
        }
        
        return $this->projectImageRepository->deleteByProjectID($id);
    }

    public function destoryProjectImage($id)
    {
        $image=$this->projectImageRepository->findwhere(['id'=>$id])->first();
        if($image){
           File::delete(public_path('uploads/projects_images/' . $image->name));
        }
        return $image->delete();

    }
    public function delete($id)
    {
        $pro=$this->projectRepository->findWhere(['id'=>$id])->first();
        $old_img_name = $this->projectRepository->getField($id, 'image');
        if ($old_img_name != null) {
            File::delete(public_path('uploads/projects/' . $old_img_name));
        }
        $this->deleteOldImages($id);
        return $pro->delete();
    }

    public function findWhere($data)
    {
        return $this->projectRepository->findWhere($data);
    }
    

    public function findAll()
    {
        return $this->projectRepository->all();
    }


}
