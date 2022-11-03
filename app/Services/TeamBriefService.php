<?php

namespace App\Services;

use App\Repository\TeamBriefRepository;
use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class TeamBriefService
{
    private $teamBriefRepository;

    public function __construct(TeamBriefRepository $teamBriefRepository)
    {
        $this->teamBriefRepository = $teamBriefRepository;
    }
    public function update($data)
    {
        $saved_data = [
            'brief_ar' => $data['brief_ar'],
            'brief_en'=>$data['brief_en']
        ];
        return $this->teamBriefRepository->update($saved_data, 1);
    }

    public function findWhere($data)
    {
        return $this->teamBriefRepository->findWhere($data);
    }

    

    


}
