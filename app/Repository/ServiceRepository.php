<?php

namespace App\Repository;
use App\Models\Service;
use Prettus\Repository\Eloquent\BaseRepository;

class ServiceRepository extends BaseRepository
{

    public function model()
    {
        return Service::class;
    }

    public function getField($id, $field)
    {
        $service = Service::where('id', $id)->first();
        return $service[$field];
    }
}
