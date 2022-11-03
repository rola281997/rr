<?php

namespace App\Repository;
use App\Models\HeaderAndFooter;
use Prettus\Repository\Eloquent\BaseRepository;

class HeaderAndFooterRepository extends BaseRepository
{

    public function model()
    {
        return HeaderAndFooter::class;
    }

    public function getField($id, $field)
    {
        $header_and_footer = HeaderAndFooter::where('id', $id)->first();
        return $header_and_footer[$field];
    }
}
