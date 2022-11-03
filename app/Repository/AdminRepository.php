<?php

namespace App\Repository;

use App\Models\Admin;
use Prettus\Repository\Eloquent\BaseRepository;

class AdminRepository extends BaseRepository
{

    public function model()
    {
        return Admin::class;
    }
}
