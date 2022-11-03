<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class ProjectImage extends Model
{
   
    protected $table = "projects_images";
    protected $guarded = [];
    public $timestamps = true;

    protected $hidden = [
       'created_at','updated_at'
    ];

    public function getImageFullPathAttribute()
    {
        if ($this->attributes['name']) {
            return asset('/uploads/projects_images/' . $this->attributes['name']);
        } else {
            return null;
        }
    }

    public function images()
    {
        return $this->belongsTo(Project::class);
    }
}

