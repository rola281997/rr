<?php

namespace App\Repository;

use App\Models\Team;
use Prettus\Repository\Eloquent\BaseRepository;

class TeamRepository extends BaseRepository
{

    public function model()
    {
        return Team::class;
    }

    public function getField($id, $field)
    {
        $team = Team::where('id', $id)->first();
        return $team[$field];
    }
}
