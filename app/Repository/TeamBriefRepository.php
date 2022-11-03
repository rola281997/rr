<?php

namespace App\Repository;

use App\Models\TeamBrief;
use Prettus\Repository\Eloquent\BaseRepository;

class TeamBriefRepository extends BaseRepository
{

    public function model()
    {
        return TeamBrief::class;
    }

   
}
