<?php

namespace App\Repository;
use App\Models\ServiceBrief;
use Prettus\Repository\Eloquent\BaseRepository;

class ServiceBriefRepository extends BaseRepository
{

    public function model()
    {
        return ServiceBrief::class;
    }

   
}
