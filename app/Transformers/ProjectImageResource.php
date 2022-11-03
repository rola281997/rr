<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectImageResource extends JsonResource
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
            "name"=>$this->imageFullPath,
            "project_id"=>$this->project_id
            
        ];
    }
}
