<?php

namespace App\Services;

use App\Repository\CategoryRepository;
use App\Repository\ProjectImageRepository;
use App\Repository\ProjectRepository;
use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class CategoryService
{
    private $categoryRepository;
    private $projectRepository;
    private $projectImageRepository;

    public function __construct(CategoryRepository $categoryRepository,ProjectRepository $projectRepository,ProjectImageRepository $projectImageRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->projectRepository=$projectRepository;
        $this->projectImageRepository=$projectImageRepository;
    }
    public function create($data)
    {
        $saved_data = [
            'name_en' => $data['name_en'],
            'name_ar' => $data['name_ar'],
        ];
        return $this->categoryRepository->create($saved_data);
    }
    public function update($data,$id)
    {
        $saved_data = [
            'name_en' => $data['name_en'],
            'name_ar' => $data['name_ar'],
            
        ];
        return $this->categoryRepository->update($saved_data, $id);
    }
    public function findWhere($data)
    {
        return $this->categoryRepository->findWhere($data);
    }

    public function findAll()
    {
        return $this->categoryRepository->all();
    }

    public function delete($id)
    {
        $category=$this->categoryRepository->findWhere(['id'=>$id])->first();
        $projects = $this->projectRepository->findWhere(['category_id'=>$id]);
        if(!empty($projects)){
            $this->deleteCategoryProjects($projects);
        }
        return $category->delete();
    }

    public function deleteCategoryProjects($projects){
        foreach($projects as $pro){
           $old_img_name = $this->projectRepository->getField($pro->id, 'image');
            if ($old_img_name != null) {
                File::delete(public_path('uploads/projects/' . $old_img_name));
            }
            $images=$this->projectImageRepository->findwhere(['project_id'=>$pro->id]);
            if(!empty($images)){
                foreach($images as $img){
                    File::delete(public_path('uploads/projects_images/' . $img->name));
                }
                $this->projectImageRepository->deleteByProjectID($pro->id);
            }
            $pro->delete();

        }
        return true;
    }
    

    


}
