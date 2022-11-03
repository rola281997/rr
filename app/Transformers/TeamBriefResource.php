<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class TeamBriefResource extends JsonResource
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
            "brief_ar"=>$this->brief_ar,
            "brief_en"=>$this->brief_en
            
        ];
    }
}
