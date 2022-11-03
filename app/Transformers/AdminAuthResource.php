<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminAuthResource extends JsonResource
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
            "token" => $this->token,
            "name" => $this->name,
            "email" => $this->email,
            
        ];
    }
}
