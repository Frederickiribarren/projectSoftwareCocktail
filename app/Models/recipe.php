<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class recipe extends Model
{
    use HasFactory;
    
    protected $fillable =[
        'name',
        'instructions',
        'glass_type',
        'garnish',
        'image_url',
        'user_id',
        'source',
        'is_private',
        'source_api_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ingredients()
    {
        return $this->hasMany(recipe_ingredients::class);
    }
}
