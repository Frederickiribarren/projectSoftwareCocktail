<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Authenticatable;

class users extends Authenticatable
{
    //
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ]
    protected $hidden =[
        'password',
        'remember_token',
    ];
    
}
