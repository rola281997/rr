<?php

namespace App\Repository;

use App\Models\Category;
use Prettus\Repository\Eloquent\BaseRepository;

class CategoryRepository extends BaseRepository
{

    public function model()
    {
        return Category::class;
    }

   
}
