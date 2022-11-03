<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class HeaderAndFooter extends Model
{
   
    protected $table = "headers_and_footers";
    protected $guarded = [];
    public $timestamps = true;

    protected $hidden = [
       'created_at','updated_at'
    ];

    public function getLogoFullPathAttribute()
    {
        if ($this->attributes['logo']) {
            return asset('/uploads/headers/' . $this->attributes['logo']);
        } else {
            return null;
        }
    }
  
}

