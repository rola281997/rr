<?php

namespace App\Services;
use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Repository\ServiceBriefRepository;
class ServiceBriefService
{
    private $clientBriefService;

    public function __construct(ServiceBriefRepository $serviceBriefRepository)
    {
        $this->serviceBriefRepository = $serviceBriefRepository;
    }
    public function update($data)
    {
        $saved_data = [
            'brief_ar' => $data['brief_ar'],
            'brief_en'=>$data['brief_en']
        ];
        return $this->serviceBriefRepository->update($saved_data, 1);
    }

    public function findWhere($data)
    {
        return $this->serviceBriefRepository->findWhere($data);
    }

    

    


}
