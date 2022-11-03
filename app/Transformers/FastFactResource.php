<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class FastFactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            'description_ar' => $this->description_ar,
            'description_en' => $this->description_en,
            'happy_clients' => $this->happy_clients,
            'employees' => $this->employees,
            'expert_developers' =>$this->expert_developers,
            'successful_projects' => $this->successful_projects,
            'video_ar'=>$this->videoArFullPath,
            'video_en'=>$this->videoEnFullPath,
        ];
    }
}
