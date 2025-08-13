<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'is_alcoholic',
        'parent_ingredient_id',
        'flavor_profile_tags',
        'source_api_id',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_ingredients');
    }
}
