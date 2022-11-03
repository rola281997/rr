<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class HeaderAndFooterResource extends JsonResource
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
            "title_ar" => $this->title_ar,
            "title_en" => $this->title_en,
            "description_ar" => $this->description_ar,
            "description_en"=>$this->description_en,
            "logo"=>$this->logoFullPath
            
        ];
    }
}
