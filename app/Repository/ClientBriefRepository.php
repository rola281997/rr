<?php

namespace App\Repository;

use App\Models\ClientBrief;
use Prettus\Repository\Eloquent\BaseRepository;

class ClientBriefRepository extends BaseRepository
{

    public function model()
    {
        return ClientBrief::class;
    }

   
}
