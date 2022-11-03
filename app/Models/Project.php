<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Project extends Model
{
   
    protected $table = "projects";
    protected $guarded = [];
    public $timestamps = true;

    protected $hidden = [
       'created_at','updated_at'
    ];

    public function getImageFullPathAttribute()
    {
        if ($this->attributes['image']) {
            return asset('/uploads/projects/' . $this->attributes['image']);
        } else {
            return null;
        }
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProjectImage::class);
    }
}

