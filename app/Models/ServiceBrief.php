<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class ServiceBrief extends Model
{
   
    protected $table = "service_brief";
    protected $guarded = [];
    public $timestamps = true;

    protected $hidden = [
       'created_at','updated_at'
    ];
}

