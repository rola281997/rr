<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class FastFact extends Model
{
   
    protected $table = "fast_facts";
    protected $guarded = [];
    public $timestamps = true;

    protected $hidden = [
       'created_at','updated_at'
    ];

    public function getVideoEnFullPathAttribute()
    {
        if ($this->attributes['video_en']) {
            return asset('/uploads/fast_facts/videos_en/' . $this->attributes['video_en']);
        } else {
            return null;
        }
    }

    public function getVideoArFullPathAttribute()
    {
        if ($this->attributes['video_ar']) {
            return asset('/uploads/fast_facts/videos_ar/' . $this->attributes['video_ar']);
        } else {
            return null;
        }
    }

    
}

