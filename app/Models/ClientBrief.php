<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class ClientBrief extends Model
{
   
    protected $table = "client_brief";
    protected $guarded = [];
    public $timestamps = true;

    protected $hidden = [
       'created_at','updated_at'
    ];
}

