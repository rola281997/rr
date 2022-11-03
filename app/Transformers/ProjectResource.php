<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Transformers\CategoryResource;
class ProjectResource extends JsonResource
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
            "description_ar"=>$this->description_ar,
            "description_en"=>$this->description_en,
            "image"=>$this->imageFullPath,
            "category"=>CategoryProjectResource::make($this->category),
            "images"=>ProjectImageResource::collection($this->images)
            
        ];
    }
}
