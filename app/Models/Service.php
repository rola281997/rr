<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Service extends Model
{
   
    protected $table = "services";
    protected $guarded = [];
    public $timestamps = true;

    protected $hidden = [
       'created_at','updated_at'
    ];

    public function getImageFullPathAttribute()
    {
        if ($this->attributes['image']) {
            return asset('/uploads/services/images/' . $this->attributes['image']);
        } else {
            return null;
        }
    }

    public function getIconFullPathAttribute()
    {
        if ($this->attributes['icon']) {
            return asset('/uploads/services/icons/' . $this->attributes['icon']);
        } else {
            return null;
        }
    }
}

