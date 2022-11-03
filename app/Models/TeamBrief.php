<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class TeamBrief extends Model
{
   
    protected $table = "team_brief";
    protected $guarded = [];
    public $timestamps = true;

    protected $hidden = [
       'created_at','updated_at'
    ];
}

