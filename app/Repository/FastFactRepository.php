<?php

namespace App\Repository;

use App\Models\FastFact;
use Prettus\Repository\Eloquent\BaseRepository;

class FastFactRepository extends BaseRepository
{

    public function model()
    {
        return FastFact::class;
    }

    public function getField($id, $field)
    {
        $fast_fact = FastFact::where('id', $id)->first();
        return $fast_fact[$field];
    }
   
}
