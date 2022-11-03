<?php

namespace App\Repository;
use App\Models\ProjectImage;
use Prettus\Repository\Eloquent\BaseRepository;

class ProjectImageRepository extends BaseRepository
{

    public function model()
    {
        return ProjectImage::class;
    }

    public function getField($id, $field)
    {
        $project = ProjectImage::where('id', $id)->first();
        return $project[$field];
    }
    public function deleteByProjectID($id){
        ProjectImage::where('project_id',$id)->delete();
    }
   
}
