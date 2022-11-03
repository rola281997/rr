<?php

namespace App\Services;
use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Repository\ContactUsRepository;
class ContactUsService
{
    private $contactUsRepository;

    public function __construct(ContactUsRepository $contactUsRepository)
    {
        $this->contactUsRepository = $contactUsRepository;
    }
    public function update($data)
    {
        $saved_data = [
            'address_ar' => $data['address_ar'],
            'address_en'=>$data['address_en'],
            'phone'=>$data['phone'],
            'whatsapp_phone'=>$data['whatsapp_phone']
        ];
        return $this->contactUsRepository->update($saved_data, 1);
    }

    public function findWhere($data)
    {
        return $this->contactUsRepository->findWhere($data);
    }

    

    


}
