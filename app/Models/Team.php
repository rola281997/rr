<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Team extends Model
{
   
    protected $table = "teams";
    protected $guarded = [];
    public $timestamps = true;

    protected $hidden = [
       'created_at','updated_at'
    ];

    public function getImageFullPathAttribute()
    {
        if ($this->attributes['image']) {
            return asset('/uploads/teams/' . $this->attributes['image']);
        } else {
            return null;
        }
    }
}

