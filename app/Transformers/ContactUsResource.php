<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactUsResource extends JsonResource
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
            "address_ar"=>$this->address_ar,
            "address_en"=>$this->address_en,
            "phone"=>$this->phone,
            "whatsapp_phone"=>$this->whatsapp_phone
            
        ];
    }
}
