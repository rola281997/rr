<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
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
            "name_ar"=>$this->name_ar,
            "name_en"=>$this->name_en,
            "position_ar"=>$this->position_ar,
            "position_en"=>$this->position_en,
            "image"=>$this->imageFullPath
            
        ];
    }
}
