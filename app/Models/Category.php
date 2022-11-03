<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Category extends Model
{
   
    protected $table = "categories";
    protected $guarded = [];
    public $timestamps = true;

    protected $hidden = [
       'created_at','updated_at'
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}

