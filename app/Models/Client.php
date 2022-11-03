<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Client extends Model
{
   
    protected $table = "clients";
    protected $guarded = [];
    public $timestamps = true;

    protected $hidden = [
       'created_at','updated_at'
    ];

    public function getImageFullPathAttribute()
    {
        if ($this->attributes['image']) {
            return asset('/uploads/clients/' . $this->attributes['image']);
        } else {
            return null;
        }
    }
}

