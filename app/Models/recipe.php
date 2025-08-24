<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class recipe extends Model
{
    use HasFactory;
    
    protected $fillable = [
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

    public function recipeIngredients()
    {
        return $this->hasMany(RecipeIngredient::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'recipe_ingredients')
                    ->withPivot('amount', 'unit');
    }
}
