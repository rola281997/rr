<?php

namespace App\Repository;

use App\Models\ContactUs;
use Prettus\Repository\Eloquent\BaseRepository;

class ContactUsRepository extends BaseRepository
{

    public function model()
    {
        return ContactUs::class;
    }

   
}
