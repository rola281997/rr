<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use App\Helpers\UploadImageHelper;
use App\Repository\TeamRepository;
class TeamService
{
    use UploadImageHelper;
    private $teamRepository;

    public function __construct(TeamRepository $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    public function create($data)
    {
        $saved_data = [
            'name_en' => $data['name_en'],
            'name_ar' => $data['name_ar'],
            'position_en' => $data['position_en'],
            'position_ar' => $data['position_ar'],
        ];
        $image_path=$this->resizeImage($data['image'],'teams','team');
        $saved_data['image']=$image_path;
        return $this->teamRepository->create($saved_data);
    }
    public function update($data,$id)
    {
        $saved_data = [
            'name_en' => $data['name_en'],
            'name_ar' => $data['name_ar'],
            'position_en' => $data['position_en'],
            'position_ar' => $data['position_ar'],
        ];
        if($data['image']){
            $image_path=$this->resizeImage($data['image'],'teams','team');
            $old_img_name = $this->teamRepository->getField($id, 'image');
            if ($old_img_name != null) {
                File::delete(public_path('uploads/teams/' . $old_img_name));
            }
            $saved_data['image']=$image_path;
        }
        
        return $this->teamRepository->update($saved_data, $id);
    }
    public function findWhere($data)
    {
        return $this->teamRepository->findWhere($data);
    }

    public function findAll()
    {
        return $this->teamRepository->all();
    }

    public function delete($id)
    {
        $team=$this->teamRepository->findWhere(['id'=>$id])->first();
        $old_img_name = $this->teamRepository->getField($id, 'image');
        if ($old_img_name != null) {
            File::delete(public_path('uploads/teams/' . $old_img_name));
        }
        return $team->delete();
    }

    


}
