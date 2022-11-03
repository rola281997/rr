<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
class Admin extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $table = "admins";
    protected $guard = 'admin';
    protected $guarded = [];
    public $timestamps = true;

    protected $hidden = [
       'created_at','updated_at'
    ];
  
}

