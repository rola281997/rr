<?php

namespace App\Repository;

use App\Models\Client;
use Prettus\Repository\Eloquent\BaseRepository;

class ClientRepository extends BaseRepository
{

    public function model()
    {
        return Client::class;
    }

    public function getField($id, $field)
    {
        $client = Client::where('id', $id)->first();
        return $client[$field];
    }
}
