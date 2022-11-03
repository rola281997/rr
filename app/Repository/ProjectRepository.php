<?php

namespace App\Repository;

use App\Models\Project;
use App\Models\ProjectImage;
use Prettus\Repository\Eloquent\BaseRepository;

class ProjectRepository extends BaseRepository
{

    public function model()
    {
        return Project::class;
    }

    public function getField($id, $field)
    {
        $project = Project::where('id', $id)->first();
        return $project[$field];
    }

   

   
}
