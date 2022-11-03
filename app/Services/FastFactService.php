<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use App\Repository\FastFactRepository;
class FastFactService
{
   
    private $fastFactRepository;

    public function __construct(FastFactRepository $fastFactRepository)
    {
        $this->fastFactRepository = $fastFactRepository;
    }

    public function update($data)
    {
        return $this->fastFactRepository->update($this->handleUpdateRequest($data), 1);
    }
    
    public function findWhere($data)
    {
        return $this->fastFactRepository->findWhere($data);
    }

    private function handleUpdateRequest($data){
        $new_data=[];
        if(key_exists('description_ar',$data)&&$data['description_ar'] !=null){
            $new_data['description_ar']=$data['description_ar'];
        }
        if(key_exists('description_en',$data)&&$data['description_en'] !=null){
            $new_data['description_en']=$data['description_en'];
        }
        if(key_exists('happy_clients',$data)&&$data['happy_clients'] !=null){
            $new_data['happy_clients']=$data['happy_clients'];
        }
        if(key_exists('employees',$data)&&$data['employees'] !=null){
            $new_data['employees']=$data['employees'];
        }
        if(key_exists('expert_developers',$data)&&$data['expert_developers'] !=null){
            $new_data['expert_developers']=$data['expert_developers'];
        }
        if(key_exists('successful_projects',$data)&&$data['successful_projects'] !=null){
            $new_data['successful_projects']=$data['successful_projects'];
        }

        if(key_exists('about_us_description_ar',$data)&&$data['about_us_description_ar'] !=null){
            $new_data['about_us_description_ar']=$data['about_us_description_ar'];
        }
        if(key_exists('about_us_description_en',$data)&&$data['about_us_description_en'] !=null){
            $new_data['about_us_description_en']=$data['about_us_description_en'];
        }
        return $new_data;
    }

    public function uploadVideo($video_type,$video,$folder){
        $old_video_name = $this->fastFactRepository->getField(1, $video_type);
        if ($old_video_name != null) {
            File::delete(public_path('uploads/fast_facts/'.$folder.'/'. $old_video_name));
        }
        $filename = 'video_'.$video->getClientOriginalName();
        $path = public_path().'/uploads/fast_facts/'.$folder;
        $video->move($path, $filename);
        return $this->fastFactRepository->update([$video_type=>$filename],1);
        
        
    }


    


}
