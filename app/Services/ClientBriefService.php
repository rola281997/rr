<?php

namespace App\Services;
use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Repository\ClientBriefRepository;
class ClientBriefService
{
    private $clientBriefService;

    public function __construct(ClientBriefRepository $clientBriefRepository)
    {
        $this->clientBriefRepository = $clientBriefRepository;
    }
    public function update($data)
    {
        $saved_data = [
            'brief_ar' => $data['brief_ar'],
            'brief_en'=>$data['brief_en']
        ];
        return $this->clientBriefRepository->update($saved_data, 1);
    }

    public function findWhere($data)
    {
        return $this->clientBriefRepository->findWhere($data);
    }

    

    


}
